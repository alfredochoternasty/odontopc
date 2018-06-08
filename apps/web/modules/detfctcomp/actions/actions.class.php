<?php

require_once dirname(__FILE__).'/../lib/detfctcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detfctcompGeneratorHelper.class.php';

/**
 * detfctcomp actions.
 *
 * @package    odontopc
 * @subpackage detfctcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detfctcompActions extends autoDetfctcompActions
{
  public function executeNew(sfWebRequest $request)
  {
    $DetFactCompra = new DetFactCompra();
    if($request->hasParameter('fid')){
      $fid = $request->getParameter('fid');
    }else{
      $fid = $this->getUser()->getAttribute('fid');
    }
    $DetFactCompra->setFactcompraId($fid);
    $this->form = new DetFactCompraForm($DetFactCompra);
    $this->det_fact_compra = $this->form->getObject();
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('fid')){
      $fid = $request->getParameter('fid');
      $this->setFilters(array("factcompra_id" => $fid));
      $this->getUser()->setAttribute('fid', $fid);
      parent::executeIndex($request);
    }else{
      $this->redirect('fact_compra');
    } 
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $det_fact_compra = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $det_fact_compra)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('detfctcomp/new?fid='.$det_fact_compra->getFactcompraId());
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('detfctcomp/index?fid='.$det_fact_compra->getFactcompraId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
