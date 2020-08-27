<?php

/**
 * carrito actions.
 *
 * @package    odontopc
 * @subpackage carrito
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carritoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if (!empty($this->getUser()->getAttribute('pid'))) {
			$this->detalle_pedido = Doctrine::getTable('DetallePedido')->findByPedidoId($this->getUser()->getAttribute('pid'));
			$this->nro_pedido = $this->getUser()->getAttribute('pid');
			$this->total_pedido = 0;
			foreach ($this->detalle_pedido as $det) {
				$this->total_pedido += $det->total;
			}
		} else {
			$this->redirect('@producto2');
		}
		$this->setLayout('layout_app');
  }

  public function executeModificar(sfWebRequest $request)
  {
		if ($request->hasParameter('detalle_id')) {
			$detalle_id = $request->getParameter('detalle_id');
			$cantidad = $request->getParameter('cantidad');
			$detalle = Doctrine::getTable('DetallePedido')->find($detalle_id);
			$detalle->cantidad = $cantidad;
			$detalle->total = $cantidad * $detalle->precio;
			$detalle->save();
			$this->redirect('@carrito');
		} else {
			$this->redirect('@producto2');
		}
  }

  public function executeFinalizar(sfWebRequest $request)
  {
    if (!empty($this->getUser()->getAttribute('pid'))) {
			if ($request->hasParameter('entrega')) {
				$pedido = Doctrine::getTable('Pedido')->find($this->getUser()->getAttribute('pid'));
				$pedido->forma_envio = ($request->getParameter('entrega') > 0)?2:1;
				
				if (!empty($request->getParameter('entrega'))) {
					$ClienteDomicilio = Doctrine::getTable('ClienteDomicilio')->find($request->getParameter('entrega'));
					$dir = $ClienteDomicilio->direccion.' - '.$ClienteDomicilio->getLocalidad();
					$pedido->cliente_domicilio_id = $request->getParameter('entrega');
				} else {
					$dir = 'Retira en Sucursal';
				}
				
				$pedido->direccion_entrega = $dir;
				$pedido->finalizado = 1;
				$pedido->zona_id = $pedido->getCliente()->zona_id;
				$this->getUser()->setAttribute('pid', 0);
				$pedido->save();
			}
			$this->setLayout('layout_app');
		} else {
			$this->redirect('@producto2');
		}
  }


  function EnviarPedidoMail($pid){
		$detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
		$pedido = Doctrine::getTable('Pedido')->find($pid);
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => 'Sistema de Pedidos'));
		$mensaje->setTo(array(
			'implantesnti@gmail.com' => 'NTI NTI',
			$pedido->getCliente()->email => $pedido->getCliente()
		));
		$mensaje->setSubject('Nuevo Pedido');
		$mensaje->setBody($this->getPartial("imprimir", array("detalles" => $detpedidos)));
		$mensaje->setContentType("text/html");
		$this->getMailer()->send($mensaje);
		$this->getUser()->setFlash('notice', 'Pedido Enviado!');
  }
	
  public function executeConfirmar(sfWebRequest $request)
  {
    if (!empty($this->getUser()->getAttribute('pid'))) {
			$pedido = Doctrine::getTable('Pedido')->find($this->getUser()->getAttribute('pid'));
			$this->domicilios = $pedido->getCliente()->getDomicilios();
			$this->setLayout('layout_app');
		} else {
			$this->redirect('@producto2');
		}
  }
	
  public function executeDomicilio(sfWebRequest $request)
  {
		$this->setLayout('layout_app');
  }

  public function executeDomiagr(sfWebRequest $request)
  {
    if (!empty($request->getParameter('domicilio'))) {
			$pedido = Doctrine::getTable('Pedido')->find($this->getUser()->getAttribute('pid'));
			$direccion = new ClienteDomicilio();
			$direccion->cliente_id = $pedido->cliente_id;
			$direccion->direccion = $request->getParameter('domicilio');
			$direccion->save();
			$this->redirect('carrito/confirmar');
		} else {
			$this->redirect('@producto2');
		}
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DetallePedidoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DetallePedidoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($detalle_pedido = Doctrine_Core::getTable('DetallePedido')->find(array($request->getParameter('id'))), sprintf('Object detalle_pedido does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetallePedidoForm($detalle_pedido);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($detalle_pedido = Doctrine_Core::getTable('DetallePedido')->find(array($request->getParameter('id'))), sprintf('Object detalle_pedido does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetallePedidoForm($detalle_pedido);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();
    $this->forward404Unless($detalle_pedido = Doctrine_Core::getTable('DetallePedido')->find(array($request->getParameter('id'))), sprintf('Object detalle_pedido does not exist (%s).', $request->getParameter('id')));
		$pedido = Doctrine::getTable('Pedido')->find($detalle_pedido->getPedidoId());
    $detalle_pedido->delete();
		// si el pedido no tiene mas productos lo borro
		$cantidad_productos = $pedido->getCantidadProductos();
		if ($cantidad_productos <= 0) {
			$this->getUser()->setAttribute('pid', 0);
			$pedido->delete();
			$this->redirect('productos/index');
		} else {
			$this->redirect('carrito/index');
		}
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $detalle_pedido = $form->save();

      $this->redirect('carrito/edit?id='.$detalle_pedido->getId());
    }
  }

}
