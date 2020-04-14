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
	}
	$this->setLayout('layout_app');
  }

  public function executeModificar(sfWebRequest $request)
  {
		$detalle_id = $request->getParameter('detalle_id');
		$cantidad = $request->getParameter('cantidad');
		$detalle = Doctrine::getTable('DetallePedido')->find($detalle_id);
		$detalle->cantidad = $cantidad;
		$detalle->total = $cantidad * $detalle->precio;
		$detalle->save();
		$this->redirect('@carrito');
  }

  public function executeFinalizar(sfWebRequest $request)
  {
    if (!empty($this->getUser()->getAttribute('pid'))) {
			if ($request->hasParameter('entrega')) {
				$pedido = Doctrine::getTable('Pedido')->find($this->getUser()->getAttribute('pid'));
				$pedido->forma_envio = ($request->getParameter('entrega') > 0)?2:1;
				$pedido->cliente_domicilio_id = !empty($request->getParameter('entrega'))?$request->getParameter('entrega'):null;
				$pedido->finalizado = 1;
				$this->getUser()->setAttribute('pid', 0);
				$pedido->save();
				$this->EnviarPedidoMail($this->getUser()->getAttribute('pid'));
			}
		}
		$this->setLayout('layout_app');
  }


  function EnviarPedidoMail($pid){
		$detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('implantesnti@gmail.com' => 'Sistemas de Pedidos'));
		$mensaje->setTo(array(
			'implantesnti@gmail.com' => 'NTI NTI',
			$detpedidos[0]->getPedido()->getCliente()->email => $detpedidos[0]->getPedido()->getCliente()
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
		}
		$this->setLayout('layout_app');
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
		}
		$this->redirect('carrito/confirmar');
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
    $detalle_pedido->delete();

    $this->redirect('carrito/index');
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
