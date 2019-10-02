<?php

require_once dirname(__FILE__).'/../lib/movprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/movprodGeneratorHelper.class.php';

/**
 * movprod actions.
 *
 * @package    odontopc
 * @subpackage movprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class movprodActions extends autoMovprodActions
{
	
  public function executeListVerTotales(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', true);
    $this->redirect('movprod/index?page=1');
  }  
  
  public function executeListVerDetallado(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', false);
    $this->redirect('movprod/index?page=1');
  }
  
  public function executeListImprimirTodo(sfWebRequest $request){
    $filtro = new MovimientoProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial($this->getUser()->getAttribute('totales', true)?"imprimir_tot":"imprimir" , array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("movimientos_producto.pdf");    
    return sfView::NONE;
  }
  
  public function executeListImprimirPagina(sfWebRequest $request){
    $filtro = new MovimientoProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());	
		$pagina = $this->getUser()->getAttribute('movprod.page', '1', 'admin_module')-1;
		$consulta->limit(50)->offset($pagina * 50);
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial($this->getUser()->getAttribute('totales', true)?"imprimir_tot":"imprimir" , array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("movimientos_producto.pdf");    
    return sfView::NONE;
  }  
  
}
