<?php

require_once dirname(__FILE__).'/../lib/listcobGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listcobGeneratorHelper.class.php';

/**
 * listcob actions.
 *
 * @package    odontopc
 * @subpackage listcob
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listcobActions extends autoListcobActions
{  
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ListadoCobrosFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("listado_cobros.pdf");    
    return sfView::NONE;
  }
  
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);  
    
    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@listado_cobros');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('listcob.filters', $this->configuration->getFilterDefaults(), 'admin_module');

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      $this->hasFilters = $this->getUser()->getAttribute('listcob.filters', $this->configuration->getFilterDefaults(), 'admin_module');
      //$this->redirect('@listado_ventas');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }  
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('listcob.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    if ($request->getParameter('sort')){
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
      $this->redirect('listcob/filter');
    }  
  }
}
