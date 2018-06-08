<?php

require_once dirname(__FILE__).'/../lib/fctcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/fctcompGeneratorHelper.class.php';

/**
 * fctcomp actions.
 *
 * @package    odontopc
 * @subpackage fctcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fctcompActions extends autoFctcompActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detfctcomp/index?fid='.$this->getRequestParameter('id'));
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $FactCompra = new FactCompra();
    if($request->hasParameter('fid')){
      $fid = $request->getParameter('fid');
      $FactCompra->setCompraId($fid);
    }
    $this->form = new FactCompraForm($FactCompra);
    $this->fact_compra = $this->form->getObject();
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $fact_compra = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $fact_compra)));
      $this->redirect('detfctcomp/new?fid='.$fact_compra->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
