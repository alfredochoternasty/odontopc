<?php

require_once dirname(__FILE__).'/../lib/insccursoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/insccursoGeneratorHelper.class.php';

/**
 * insccurso actions.
 *
 * @package    odontopc
 * @subpackage insccurso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class insccursoActions extends autoInsccursoActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new CursoInscripcionFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    //$consulta->orderBy('nombre asc');
    $inscriptos = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("inscriptos" => $inscriptos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("inscriptos.pdf");    
    return sfView::NONE;
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('cid')){
      $cid = $request->getParameter('cid');
      $this->getUser()->setAttribute('cid', $cid);
    }else{
      $cid = $this->getUser()->getAttribute('cid');
    } 
    $this->setFilters(array("curso_id" => $cid));
    parent::executeIndex($request);
  }  
}
