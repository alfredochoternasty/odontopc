<?php

require_once dirname(__FILE__).'/../lib/ultcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ultcompGeneratorHelper.class.php';

/**
 * ultcomp actions.
 *
 * @package    odontopc
 * @subpackage ultcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ultcompActions extends autoUltcompActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'ultcompdet/index?rid='.$this->getRequestParameter('id'));
  }

  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ClienteUltimaCompraFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $listado = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("listado" => $listado)));
    $dompdf->set_paper('letter','portrait');
    $dompdf->render();
    $dompdf->stream("ultima_compra.pdf");    
    return sfView::NONE;
  }
}
