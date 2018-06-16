<?php

require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorHelper.class.php';

/**
 * ctrlstock actions.
 *
 * @package    odontopc
 * @subpackage ctrlstock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctrlstockActions extends autoCtrlstockActions
{
	/*
  public function executeListTotales(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', true);
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $this->redirect('ctrlstock/filter');
  }  
  
  public function executeListDetalle(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', false);
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $this->redirect('ctrlstock/filter');
  }
  */
	
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ControlStockFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
		$dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("control_stock.pdf");    
    return sfView::NONE;
  }
  
	/*
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);  
    
    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@control_stock');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      $this->hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }  
  
	
  public function executeIndex(sfWebRequest $request)
  {
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    if ($request->getParameter('sort')){
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
      $this->redirect('ctrlstock/filter');
    }  
  }
	*/
  
}
