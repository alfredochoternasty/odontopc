<?php

require_once dirname(__FILE__).'/../lib/listfvtaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listfvtaGeneratorHelper.class.php';

/**
 * listfvta actions.
 *
 * @package    odontopc
 * @subpackage listfvta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listfvtaActions extends autoListfvtaActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new VtaFactFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $consulta->orderBy('nombre_prod asc');
    $consulta->addOrderBy('fecha asc');
    $vta_fact = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("vta_fact" => $vta_fact)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("vta_fact.pdf");    
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
  
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@vta_fact');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      $this->hasFilters = $this->getUser()->getAttribute('listfvta.filters', $this->configuration->getFilterDefaults(), 'admin_module');
      //$this->redirect('@vta_fact');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }  
}
