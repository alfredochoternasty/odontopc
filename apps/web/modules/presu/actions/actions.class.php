<?php

require_once dirname(__FILE__).'/../lib/presuGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/presuGeneratorHelper.class.php';

/**
 * presu actions.
 *
 * @package    odontopc
 * @subpackage presu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class presuActions extends autoPresuActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detpresu/index?pid='.$this->getRequestParameter('id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $presu = $form->save();      
      $this->redirect( 'detpresu/new?pid='.$presu->getId());
    }
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $pid = $this->getRequestParameter('id');
    $presupuesto = Doctrine::getTable('Presupuesto')->find($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("presupuesto" => $presupuesto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("presupuesto.pdf");    
    return sfView::NONE;
  }  
}
