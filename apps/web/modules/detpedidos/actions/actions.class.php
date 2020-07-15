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
  
  public function executeListVender(sfWebRequest $request){
    $pedido = Doctrine::getTable('Pedido')->find($this->getRequestParameter('pid'));
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
      $this->resumen = new Resumen();
      $this->resumen->setClienteId($pedido->cliente_id);
      $this->resumen->setPedidoId($pedido->id);
      $tipos_fact = $this->pedido->getCliente()->getTiposFacturas()->orderBy('id ASC');
      $this->resumen->setTipofacturaId($tipos_fact[0]->id);      
      $this->getUser()->setFlash('notice', 'Factura generada para el Pedido Nro '.$pedido->id.' del cliente '.$pedido->getCliente(), false);
      $this->redirect('resumen/index');
    } else {
      $this->getUser()->setFlash('error', 'Hay productos que no tiene lotes asignados', false);
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
