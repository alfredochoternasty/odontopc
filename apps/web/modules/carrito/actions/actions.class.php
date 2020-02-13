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
    $this->detalle_pedidos = Doctrine_Core::getTable('DetallePedido')
      ->createQuery('a')
      ->execute();
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
