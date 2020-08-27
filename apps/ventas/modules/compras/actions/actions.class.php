<?php

require_once dirname(__FILE__).'/../lib/comprasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/comprasGeneratorHelper.class.php';

/**
 * compras actions.
 *
 * @package    odontopc
 * @subpackage compras
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comprasActions extends autoComprasActions
{

  public function executeListImprimir(sfWebRequest $request){
    $filtro = new compra2FormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $compras = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("compras" => $compras)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("compras.pdf");    
    return sfView::NONE;
  }
  
}
