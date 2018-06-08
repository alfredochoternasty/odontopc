<?php

require_once dirname(__FILE__).'/../lib/saldosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/saldosGeneratorHelper.class.php';

/**
 * saldos actions.
 *
 * @package    odontopc
 * @subpackage saldos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class saldosActions extends autoSaldosActions
{
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ClienteFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $saldos = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("saldos" => $saldos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("saldos.pdf");    
    return sfView::NONE;
  }
}
