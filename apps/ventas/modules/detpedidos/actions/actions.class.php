<?php

require_once dirname(__FILE__).'/../lib/detpedidosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detpedidosGeneratorHelper.class.php';

/**
 * detpedidos actions.
 *
 * @package    odontopc
 * @subpackage detpedidos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detpedidosActions extends autoDetpedidosActions
{
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    } 
    $this->getUser()->setAttribute('pid', $pid);
    $this->setFilters(array("pedido_id" => $pid));
    $this->pedido_original = Doctrine::getTable('DetallePedidoOriginal')->findByPedidoId($pid);
    parent::executeIndex($request);
  }

  public function executeNew(sfWebRequest $request){
    $detped = new DetallePedido();
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    $detped->setPedidoId($pid);
    $this->form = new DetallePedidoForm($detped);
    $this->detalle_pedido = $this->form->getObject();
    
    $this->pager2 = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
  }
  
  public function executeListVender(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 0);
    $this->Vender($pid);
  }
  
  public function executeListRemito(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 0);
    $this->Vender($pid, true);    
  }
  
  public function Vender($p_pid, $p_es_remito=false){
    $pedido = Doctrine::getTable('Pedido')->find($p_pid);
    if ($pedido->SePuedeVender()) {
      $resumen = new Resumen();
      $resumen->cliente_id = $pedido->cliente_id;
      $resumen->pedido_id = $pedido->id;
      $resumen->zona_id = $pedido->getCliente()->zona_id; 
      if ($p_es_remito || in_array($pedido->cliente_id, array(635,536))) {
        $resumen->tipofactura_id = 4;
      } else {
        $tipos_facturas = Doctrine::getTable('TipoFactura')->findAll();
        foreach ($tipos_facturas as $tipo_factura) {
          $cond_fiscales = explode(',', $tipo_factura->cond_fiscales);
          if ($pedido->getCliente()->condicionfiscal_id == $cond_fiscales[0]) {
            $resumen->tipofactura_id = $tipo_factura->id;
            break;
          }
        }
      }
      $resumen->usuario = $this->getUser()->getGuardUser()->getId();
      $resumen->fecha = date('Y-m-d');
      $resumen->save();
      
      $promos_pedido = $pedido->getPromosPedido();
      foreach ($promos_pedido as $k => $promo)
        if (!$pedido->ControlarPromo($promo->id))
          unset($promos_pedido[$k]);
      
      $det_pedido = $pedido->getDetalle();
      foreach($det_pedido as $detalle_pedido) {
        if (!empty($detalle_pedido->nro_lote)) {
          $descuento = 0;
          foreach ($promos_pedido as $promo) {
            if ($promo->estado) {
              if ($promo->ProductoEnPromocion($detalle_pedido->producto_id)) {
                if ($detalle_pedido->cantidad == $promo->cant_regalo) {
                  $descuento = $promo->porc_desc;
                  $promo->estado = 0;
                } elseif ($detalle_pedido->cantidad > $promo->cant_regalo) {
                  $nuevo_det_pedido = clone $detalle_pedido;
                  $nuevo_det_pedido->cantidad = $promo->cant_regalo;
                  $detalle_pedido->cantidad = $detalle_pedido->cantidad - $promo->cant_regalo;
                  $detalle_resumen = $resumen->AgregarProductoDePedido($nuevo_det_pedido, $promo->porc_desc);
                  $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
                  $descuento = 0;
                  $promo->estado = 0;
                } else {
                  $promo->cant_regalo = $promo->cant_regalo - $detalle_pedido->cantidad;
                  $descuento = $promo->porc_desc;
                }
              }
            }
          }
          $detalle_resumen = $resumen->AgregarProductoDePedido($detalle_pedido, $descuento);
          $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
        }
      } 
      
      $pedido->vendido = 1;
      $pedido->fecha_venta = date('Y-m-d');
      $pedido->usuario_id = $this->getUser()->getGuardUser()->getId();
      $pedido->save();
      
      $this->getUser()->setFlash('notice', 'Factura generada para el Pedido Nro '.$pedido->id.' del cliente '.$pedido->getCliente(), true);
      $this->redirect('resumen/index');
    } else {
      $this->getUser()->setFlash('error', 'No hay productos con lotes asignados', true);
      $this->redirect('detpedidos/index?pid='.$pedido->id);      
    }
  }
  
  public function executeListAsignarLote(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid');
    $detalles = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
    foreach ($detalles as $detalle) {
      $detalle->AsignarLote();
    }
    $this->executeIndex($request);
    $this->setTemplate('index');
  }
  
  public function executeGet_cantidad_lote(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
      ->select('l.stock')
      ->from('Lote l')
      ->where('l.nro_lote = \''.$request->getparameter('lid').'\'')
      ->andWhere('l.producto_id = \''.$request->getparameter('pid').'\'')
			->andWhere("l.nro_lote not like 'er%'")
      ->andWhere('l.stock > 0 ')
      ->andWhere('l.fecha_vto > '.date('Y-m-d'));
     
    $lotes = $q->fetchArray();  
    $cantidad = $lotes[0]['stock'];
    $options[] = '<option value="">1</option>';
    for($i = 2; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 1);
    $detpedidos = Doctrine::getTable('DetallePedido')->findByPedidoId($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("detalles" => $detpedidos, 'lotes' => true)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("pedido_nro_$pid.pdf");    
    return sfView::NONE;
  }

  public function executeListOriginal(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 1);
    $detpedidos = Doctrine::getTable('DetallePedidoOriginal')->findByPedidoId($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("detalles" => $detpedidos, 'lotes' => false)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("pedido_nro_$pid.pdf");
    return sfView::NONE;
  }
  
  public function executeListEliminar(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid', 1);
    $this->redirect("pedidos/edit?id=$pid");
  }  
}
