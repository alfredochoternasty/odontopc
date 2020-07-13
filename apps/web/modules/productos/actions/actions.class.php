<?php

/**
 * productos actions.
 *
 * @package    odontopc
 * @subpackage productos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
		if ($request->getParameter('grupo_id') == '-' || empty($this->getUser()->getAttribute('grupo_id'))) {
			$this->productos = Doctrine::getTable('Producto')->getActivos();
			$this->grupo_id = 0;
		} else {
			$this->grupo_id = empty($request->getParameter('grupo_id'))?$this->getUser()->getAttribute('grupo_id'):$request->getParameter('grupo_id');
			$this->productos = Doctrine::getTable('Producto')->findByGrupoprodIdAndActivo($this->grupo_id, 1);
			$this->getUser()->setAttribute('grupo_id', $this->grupo_id);
		}
		
		$this->grupos_prod = Doctrine_Core::getTable('Grupoprod')->createQuery('a')->where('id not in (1,6,15,16)')->execute();
    $this->setLayout('layout_app');
  }

  public function executePedir(sfWebRequest $request)
  {
	$producto_id = $request->getParameter('producto_id');
	$cantidad = $request->getParameter('cantidad');
	if (empty($this->getUser()->getAttribute('pid'))) {
		$id_usuario = $this->getUser()->getGuardUser()->getId();
		$clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
		$id_cliente = $clientes[0]->getId();
		$pedido = new Pedido();
		$pedido->setFecha(date('Y-m-d'));
		$pedido->setClienteId($id_cliente);
		$pedido->save();
		$id_ped = $pedido->getId();
		$this->getUser()->setAttribute('pid', $id_ped);
	}
	
	$detalle_pedido = new DetallePedido();
	$detalle_pedido->pedido_id = $this->getUser()->getAttribute('pid');
	$detalle_pedido->producto_id = $producto_id;
	$detalle_pedido->cantidad = $cantidad;
	$producto = Doctrine::getTable('Producto')->find($producto_id);
	$detalle_pedido->precio = $producto->precio_vta;
	$detalle_pedido->total = $producto->precio_vta * $cantidad;
	$detalle_pedido->save();
	$this->redirect('producto2');
  }

  public function executeCarrito(sfWebRequest $request)
  {
    if (!empty($this->getUser()->getAttribute('pid'))) {
		$this->detalle_pedido = Doctrine::getTable('DetallePedido')->findByPedidoId($this->getUser()->getAttribute('pid'));
	}
	$this->setLayout('layout_app');
	$this->setTemplate('carrito');
  }

  public function executeModificar(sfWebRequest $request)
  {
	$detalle_id = $request->getParameter('detalle_id');
	$cantidad = $request->getParameter('cantidad');
	$detalle = new DetallePedido($detalle_id);
	$detalle->cantidad = $cantidad;
	$detalle->save();
	$this->setLayout('layout_app');
	$this->setTemplate('carrito');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProductoForm($producto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    $producto->delete();

    $this->redirect('productos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $producto = $form->save();

      $this->redirect('productos/edit?id='.$producto->getId());
    }
  }

}
