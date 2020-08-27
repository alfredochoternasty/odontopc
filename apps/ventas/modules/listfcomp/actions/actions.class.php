<?php

require_once dirname(__FILE__).'/../lib/listfcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listfcompGeneratorHelper.class.php';

/**
 * listfcomp actions.
 *
 * @package    odontopc
 * @subpackage listfcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listfcompActions extends autoListfcompActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new CompFactFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $consulta->orderBy('nombre_prod asc');
    $consulta->addOrderBy('fecha asc');
    $comp_fact = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("comp_fact" => $comp_fact)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("comp_fact.pdf");    
    return sfView::NONE;
  }
  
  public function executeListTotales(sfWebRequest $request){
	$this->getUser()->setAttribute('totales', true);
	$this->executeIndex($request);
	$this->setTemplate('index');
  }  
  
  public function executeListDetalle(sfWebRequest $request){
	$this->getUser()->setAttribute('totales', false);
	$this->executeIndex($request);
	$this->setTemplate('index');	
  } 
  
}
