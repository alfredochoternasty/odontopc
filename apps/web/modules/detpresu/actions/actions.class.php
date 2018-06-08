<?php

require_once dirname(__FILE__).'/../lib/detpresuGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detpresuGeneratorHelper.class.php';

/**
 * detpresu actions.
 *
 * @package    odontopc
 * @subpackage detpresu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detpresuActions extends autoDetpresuActions
{
  public function executeActprecio(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $prid = $request->getParameter('prid');
    $lista_precio = Doctrine::getTable('Presupuesto')->find($prid)->getListaId();
    $prec_prod = Doctrine::getTable('Producto')->find($pid)->getPrecioFinal($lista_precio);
    return $this->renderText(json_encode(sprintf("%01.2f", $prec_prod)));
  }
  
  public function executeNew(sfWebRequest $request)  {
    $detpres = new DetallePresupuesto();
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $this->getUser()->setAttribute('pid', $pid);
    $detpres->setPresupuestoId($pid);
    $this->form = new DetallePresupuestoForm($detpres);
    $this->detalle_presupuesto = $this->form->getObject();
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $this->setFilters(array("presupuesto_id" => $pid));
    $this->getUser()->setAttribute('pid', $pid);
    parent::executeIndex($request);
  }

  public function executeListImprimir(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 1);
    $presupuesto = Doctrine::getTable('Presupuesto')->find($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("presupuesto" => $presupuesto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("presupuesto.pdf");    
    return sfView::NONE;
  }
}
