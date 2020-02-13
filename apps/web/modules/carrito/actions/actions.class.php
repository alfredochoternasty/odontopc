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
    $request->checkCSRFProtection();

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
