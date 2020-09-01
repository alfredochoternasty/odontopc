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
	
  public function executeListImprimirTodo(sfWebRequest $request){
    //$filtro = new ControlStockFormFilter();
    //$consulta = $filtro->buildQuery($this->getFilters());
	$consulta = $this->buildQuery($this->getFilters());
	$consulta->orderBy('nombre');
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
		$dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("control_stock.pdf");    
    return sfView::NONE;
  }	
	
  public function executeListImprimirPagina(sfWebRequest $request){
    $filtro = new ControlStockFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('ctrlstock.page', '1', 'admin_module')-1;
		$consulta->limit(40)->offset($pagina * 40);
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
		$dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("control_stock.pdf");    
    return sfView::NONE;
  }
	
  public function executeIndex(sfWebRequest $request)
  {
		if (!empty($this->getUser()->getAttribute('ctrlstock.filters', ''))) parent::executeIndex($request);
		$this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
  
}
