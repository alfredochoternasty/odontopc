<?php

require_once dirname(__FILE__).'/../lib/vtaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vtaGeneratorHelper.class.php';

/**
 * vta actions.
 *
 * @package    odontopc
 * @subpackage vta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtaActions extends autoVtaActions
{

  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detvta/index?vid='.$this->getRequestParameter('id'));
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $venta = $form->save();
      $this->redirect('detvta/new?vid='.$venta->getId());
    }
  }  
  
  public function executeGet_vtas_cliente(sfWebRequest $request){
    $vtas = Doctrine::getTable('Resumen')->findByClienteId($request->getparameter('cid'));
    foreach($vtas as $vta){
      $options[] = '<option value="'.$vta->getId().'">Nro: '.$vta->getId().' - Fecha: '.implode('/', array_reverse(explode('-', $vta->getFecha()))).'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->setFilters(array("resumen_id" => $rid));
    } 
    parent::executeIndex($request);
  }  
}
