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
  
  public function executeListImprimirTodo(sfWebRequest $request){
    $consulta = $this->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial('imprimir_tot' , array("listado" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("listado_ventas.pdf");    
    return sfView::NONE;
  } 
  
}
