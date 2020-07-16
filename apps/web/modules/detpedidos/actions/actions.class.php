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
  
  
  // public function executeListVender(sfWebRequest $request){
    // $pid = $this->getUser()->getAttribute('pid');
    // $this->redirect( 'resumen/new?pid='.$pid);
  // }
  
  public function executeListVender(sfWebRequest $request){
    if($request->hasParameter('pid')){
      $pid = $request->getParameter('pid');
    }else{
      $pid = $this->getUser()->getAttribute('pid');
    }
    
    $pedido = Doctrine::getTable('Pedido')->find($pid);
    $det_pedido = Doctrine::getTable('DetallePedido')->findByPedidoId($pedido->id);
		
    $todos_tienen_lote = '';
    foreach ($det_pedido as $det) {
      $nro_lote = $det->getNroLote();
      if (empty($nro_lote)) {
        $todos_tienen_lote = 'N';
        break;
      } else {
        $todos_tienen_lote = 'S';
      }
    }
    
    if ($todos_tienen_lote == 'S') {
      $res = new Resumen();
      $res->cliente_id = $pedido->cliente_id;
      $res->pedido_id = $pedido->id;
      $res->zona_id = $pedido->getCliente()->zona_id; 
      $res->tipofactura_id = 1;
      $res->usuario = $this->getUser()->getGuardUser()->getId();
      $res->fecha = date('Y-m-d');
      $res->save();
      
      foreach($det_pedido as $detalle):
        $detalle_resumen = new DetalleResumen();
        $detalle_resumen->resumen_id = $res->id;
        $detalle_resumen->producto_id = $detalle->producto_id;
        $detalle_resumen->nro_lote = $detalle->nro_lote;
        $detalle_resumen->precio = ($detalle->precio/1.21); //precio sin iva
        $detalle_resumen->cantidad = $detalle->cantidad;
        $sub_total = $detalle_resumen->precio * $detalle_resumen->cantidad;
        $iva = $sub_total * 0.21;
        $total = $sub_total + $iva;
        $detalle_resumen->sub_total = $sub_total;
        $detalle_resumen->iva = $iva;
        $detalle_resumen->total = $total;
        $detalle_resumen->observacion = $detalle->observacion;
        $detalle_resumen->save();
        $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
      endforeach;
      
      $pedido->vendido = 1;
      $pedido->fecha_venta = date('Y-m-d');
      $pedido->save();
      
      $this->getUser()->setFlash('notice', 'Factura generada para el Pedido Nro '.$pedido->id.' del cliente '.$pedido->getCliente(), true);
      $this->redirect('resumen/index');
    } else {
      $this->getUser()->setFlash('error', 'Hay productos que no tiene lotes asignados', true);
      $this->redirect('detpedidos/index?pid='.$pedido->id);      
    }
  }
  
  public function executeListAsignarLote(sfWebRequest $request){
    $pid = $this->getUser()->getAttribute('pid');
    $detalle = Doctrine::getTable('Pedido')->find($pid)->getDetalle();
    foreach ($detalle as $fila) {
      $fila->AsignarLote();
    }
    $this->redirect('detpedidos/index?pid='.$pid);
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
    $dompdf->load_html($this->getPartial("imprimir", array("detalles" => $detpedidos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("pedido_nro_$pid.pdf");    
    return sfView::NONE;
  }  
}
