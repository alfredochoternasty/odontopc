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
    $this->presupuesto_detalle = Doctrine::getTable('DetallePresupuesto')->findByPresupuestoId($pid);
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $this->getUser()->setAttribute('pid', $pid);
    $this->detalle_presupuesto = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->detalle_presupuesto);
    $this->presupuesto_detalle = Doctrine::getTable('DetallePresupuesto')->findByPresupuestoId($pid);
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $this->setFilters(array("presupuesto_id" => $pid));
    $this->getUser()->setAttribute('pid', $pid);
    
    $presupuesto = Doctrine::getTable('Presupuesto')->find($pid);
    if (empty($presupuesto->cliente_id)) $this->getUser()->setFlash('notice', 'El presupuesto no está asignado a un cliente', true);
    parent::executeIndex($request);
  }

  protected function getPager2($pid)
  {
    $pager = $this->configuration->getPager('DetallePresupuesto');
    $query = Doctrine::getTable('DetallePresupuesto')->createQuery()->where('presupuesto_id = ?', $pid);
    $pager->setQuery($query);
    $pager->setPage(1);
    $pager->init();

    return $pager;
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
  
  public function executeListAsignarLote(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid');
    $detalles = Doctrine::getTable('DetallePresupuesto')->findByPresupuestoId($pid);
    foreach ($detalles as $detalle) {
      $detalle->AsignarLote();
    }
    $this->executeIndex($request);
    $this->setTemplate('index');
  }
  
  public function executeListVender(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 0);
    $this->Vender($pid);
  }
  
  public function Vender($p_pid, $p_es_remito=false){
    $presupuesto = Doctrine::getTable('Presupuesto')->find($p_pid);
    if (empty($presupuesto->cliente_id)) {
      $this->getUser()->setFlash('error', 'El presupuesto no está asignado a un cliente', true);
      $this->redirect('detpresu/index?pid='.$presupuesto->id);  
    }
    if (!$presupuesto->SePuedeVender()) {
      $this->getUser()->setFlash('error', 'No hay productos con lotes asignados', true);
      $this->redirect('detpresu/index?pid='.$presupuesto->id);
    }
    
    $resumen = new Resumen();
    $resumen->cliente_id = $presupuesto->cliente_id;
    $resumen->presupuesto_id = $presupuesto->id;
    $resumen->zona_id = $presupuesto->zona_id; 
    if ($p_es_remito || in_array($presupuesto->cliente_id, array(635,536))) {
      $resumen->tipofactura_id = 4;
    } else {
      $tipos_facturas = Doctrine::getTable('TipoFactura')->findAll();
      foreach ($tipos_facturas as $tipo_factura) {
        $cond_fiscales = explode(',', $tipo_factura->cond_fiscales);
        if ($presupuesto->getCliente()->condicionfiscal_id == $cond_fiscales[0]) {
          $resumen->tipofactura_id = $tipo_factura->id;
          break;
        }
      }
    }
    $resumen->usuario = $this->getUser()->getGuardUser()->getId();
    $resumen->fecha = date('Y-m-d');
    $resumen->save();
    
    $promos_presupuesto = array();
    // $promos_presupuesto = $presupuesto->getPromospresupuesto();
    // foreach ($promos_presupuesto as $k => $promo)
      // if (!$presupuesto->ControlarPromo($promo->id))
        // unset($promos_presupuesto[$k]);
    
    $det_presupuesto = $presupuesto->getDetalle();
    foreach($det_presupuesto as $detalle_presupuesto) {
      if (!empty($detalle_presupuesto->nro_lote)) {
        $descuento = 0;
        foreach ($promos_presupuesto as $promo) {
          if ($promo->estado) {
            if ($promo->ProductoEnPromocion($detalle_presupuesto->producto_id)) {
              if ($detalle_presupuesto->cantidad == $promo->cant_regalo) {
                $descuento = $promo->porc_desc;
                $promo->estado = 0;
              } elseif ($detalle_presupuesto->cantidad > $promo->cant_regalo) {
                $nuevo_det_presupuesto = clone $detalle_presupuesto;
                $nuevo_det_presupuesto->cantidad = $promo->cant_regalo;
                $detalle_presupuesto->cantidad = $detalle_presupuesto->cantidad - $promo->cant_regalo;
                $detalle_resumen = $resumen->AgregarProductoDepresupuesto($nuevo_det_presupuesto, $promo->porc_desc);
                $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
                $descuento = 0;
                $promo->estado = 0;
              } else {
                $promo->cant_regalo = $promo->cant_regalo - $detalle_presupuesto->cantidad;
                $descuento = $promo->porc_desc;
              }
            }
          }
        }
        $detalle_resumen = $resumen->AgregarProductoDePresupuesto($detalle_presupuesto);
        $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
      }
    } 
    
    $presupuesto->vendido = 1;
    $presupuesto->fecha_venta = date('Y-m-d');
    $presupuesto->usuario_id = $this->getUser()->getGuardUser()->getId();
    $presupuesto->save();
    
    $this->getUser()->setFlash('notice', 'Factura generada para el presupuesto Nro '.$presupuesto->id.' del cliente '.$presupuesto->getCliente(), true);
    $this->redirect('resumen/index');
  }
  
  public function executeListCliente(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 0);
    $this->redirect('presu/edit?id='.$pid);  
  }
}
