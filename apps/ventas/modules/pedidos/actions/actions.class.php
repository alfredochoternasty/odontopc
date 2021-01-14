<?php

require_once dirname(__FILE__).'/../lib/pedidosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pedidosGeneratorHelper.class.php';

/**
 * pedidos actions.
 *
 * @package    odontopc
 * @subpackage pedidos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pedidosActions extends autoPedidosActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detpedidos/index?pid='.$this->getRequestParameter('id'));
  }
  
  public function executeListVender(sfWebRequest $request){
    $this->redirect( 'detpedidos/vender?pid='.$this->getRequestParameter('id'));
  }  
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $pedido = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pedido)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@pedido_pedidos_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $pedido->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'pedido_pedidos_edit', 'sf_subject' => $pedido));
          $this->redirect('@pedido_pedidos');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeListEliminar(sfWebRequest $request)
  {
    $this->pedido = $this->getRoute()->getObject();
    $this->pedido->vendido = 1;
    $this->pedido->forma_envio = 9;
    $this->pedido->fecha_venta = date('Y-m-d');
    $this->form = $this->configuration->getForm($this->pedido);
    $this->setTemplate('edit');
  }
}
