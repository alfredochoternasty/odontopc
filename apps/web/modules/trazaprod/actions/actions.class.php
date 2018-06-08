<?php

require_once dirname(__FILE__).'/../lib/trazaprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/trazaprodGeneratorHelper.class.php';

/**
 * trazaprod actions.
 *
 * @package    odontopc
 * @subpackage trazaprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class trazaprodActions extends autoTrazaprodActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new Traza2FormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
/*    $consulta->leftJoin('r.Producto p');
    $consulta->leftJoin('p.Grupo gr');
    $consulta->andWhere('p.activo = 1');
    $consulta->andWhere('p.grupoprod_id <> 1');
    $consulta->andWhere('p.grupoprod_id <> 15');
    $consulta->orderBy('gr.nombre asc, p.orden_grupo asc, p.nombre asc');*/
    $traza = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("traza" => $traza)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("traza.pdf");    
    return sfView::NONE;
  }
}
