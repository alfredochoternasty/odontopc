<?php

require_once dirname(__FILE__).'/../lib/compraGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/compraGeneratorHelper.class.php';

/**
 * compra actions.
 *
 * @package    odontopc
 * @subpackage compra
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class compraActions extends autoCompraActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detcomp/index?cid='.$this->getRequestParameter('id'));
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $compra = $form->save();
      $this->getUser()->setFlash('notice', $notice);
      if ($request->hasParameter('_save_and_add')){
        $this->redirect('detcomp/new?cid='.$compra->getId());
      }else{
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('@compra');
      }      
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
  public function executeGetnroremito(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    if(empty($pid)){
      $pid = $this->getUser()->getAttribute('pid');
    }
    $proveedor = Doctrine::getTable('Proveedor')->find($pid);
    $nro = $proveedor->getProxRemito();
    return $this->renderText(json_encode($nro));
  }
}
