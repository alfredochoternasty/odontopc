<?php

require_once dirname(__FILE__).'/../lib/listcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listcompGeneratorHelper.class.php';

/**
 * listcomp actions.
 *
 * @package    odontopc
 * @subpackage listcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listcompActions extends autoListcompActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ListadoComprasFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("listado_compras.pdf");    
    return sfView::NONE;
  }
  
}
