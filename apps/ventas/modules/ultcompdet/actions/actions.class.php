<?php

require_once dirname(__FILE__).'/../lib/ultcompdetGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ultcompdetGeneratorHelper.class.php';

/**
 * ultcompdet actions.
 *
 * @package    odontopc
 * @subpackage ultcompdet
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ultcompdetActions extends autoUltcompdetActions
{
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    } 
    $this->setFilters(array("resumen_id" => $rid));
    parent::executeIndex($request);
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $rid = $this->getUser()->getAttribute('rid', 1);
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("reporte.pdf");    
    return sfView::NONE;
  }  
}
