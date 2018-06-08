<?php

require_once dirname(__FILE__).'/../lib/stockGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stockGeneratorHelper.class.php';

/**
 * stock actions.
 *
 * @package    odontopc
 * @subpackage stock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockActions extends autoStockActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
	$consulta->leftJoin('r.Grupo gr');
	$consulta->andWhere('r.activo = 1');
    $consulta->andWhere('r.grupoprod_id <> 1');
    $consulta->andWhere('r.grupoprod_id <> 15');
	$consulta->orderBy('gr.nombre asc, r.orden_grupo asc, r.nombre asc');
    $stock = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("stock" => $stock)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("stock.pdf");    
    return sfView::NONE;
  }
}
