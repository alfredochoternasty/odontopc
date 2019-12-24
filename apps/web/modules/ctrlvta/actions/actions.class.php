<?php

require_once dirname(__FILE__).'/../lib/ctrlvtaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ctrlvtaGeneratorHelper.class.php';

/**
 * ctrlvta actions.
 *
 * @package    odontopc
 * @subpackage ctrlvta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctrlvtaActions extends autoCtrlvtaActions
{  

  public function executeListVerTotales(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', true);
    $this->redirect('ctrlvta/index?page=1');
  }  
  
  public function executeListVerDetallado(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', false);
    $this->redirect('ctrlvta/index?page=1');
  }
  
  public function executeListImprimirTodo(sfWebRequest $request){
    $consulta = $this->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial($this->getUser()->getAttribute('totales', true)?"imprimir_tot":"imprimir" , array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("listado_ventas.pdf");    
    return sfView::NONE;
  }
  
  public function executeListImprimirPagina(sfWebRequest $request){
    if ($this->getUser()->getAttribute('totales')) {
      $this->getUser()->setFlash('error', '"Imprimir pagina" es solo para el listado detallado, utilice la opción "Imprimir todo"');
      $this->redirect('ctrlvta/index?page=1');
    } else {
      //$filtro = new ListadoVentasFormFilter();
      $consulta = $this->buildQuery($this->getFilters());	
      $pagina = $this->getUser()->getAttribute('ctrlvta.page', '1', 'admin_module')-1;
      $consulta->limit(50)->offset($pagina * 50);
      $listado = $consulta->execute();
      
      $dompdf = new DOMPDF();
      $dompdf->load_html($this->getPartial($this->getUser()->getAttribute('totales', true)?"imprimir_tot":"imprimir" , array("listado" => $listado)));
      $dompdf->set_paper('A4','landscape');
      $dompdf->render();
      $dompdf->stream("listado_ventas.pdf");    
      return sfView::NONE;
    }
  }  
  
  /*
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);  
    
    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@listado_ventas');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlvta.filters', $this->configuration->getFilterDefaults(), 'admin_module');

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      $this->hasFilters = $this->getUser()->getAttribute('ctrlvta.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }

    $this->pager = $this->getPager();
		if ($this->pager->count() > 500) {
			$this->getUser()->setFlash('error', 'El listado es demasiado grande! por favor seleccione otro filtro para achicar la cantidad de resultados');
			$this->redirect('@listado_ventas');
		}
    $this->sort = $this->getSort();
  }  
  
  public function executeIndex(sfWebRequest $request)
  {
	
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $this->hasFilters = $this->getUser()->getAttribute('ctrlvta.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    if ($request->getParameter('sort')){
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
      $this->redirect('ctrlvta/filter');
    } 
		
  }
  */
}
