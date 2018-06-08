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
    $this->redirect( 'resumen/new?pid='.$this->getRequestParameter('id'));
  }  
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->getRoute()->getObject()->getDetalle()->delete();
    $this->getRoute()->getObject()->delete();
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $this->redirect('@pedido_pedidos');
  }  
}
