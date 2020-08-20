<?php

/**
 * Pedido
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Pedido extends BasePedido
{
  /*public function __toString()
  {
        return $this->getCliente();
  }*/
  
  
  
  public function getTotal() {
    $rsTotal = Doctrine_Core::getTable('DetallePedido')
      ->createQuery('dp')
      ->select('sum(total) as total')
      ->where('pedido_id = '.$this->getId())
      ->execute();
    return $rsTotal[0]->total;
  }
  
  public function getCantidadProductos() {
    $rs = Doctrine::getTable('DetallePedido')->findByPedidoId($this->getId());
    return count($rs);
  }
  
  public function getPromosPedido(){
    $sql_promo_prod = Doctrine_Core::getTable('PromocionProducto')->createQuery('pp');
    
    $sql_prods_pedido = $sql_promo_prod->createSubquery()
      ->select('dp.producto_id')
      ->from('DetallePedido dp')
      ->where('dp.pedido_id = '.$this->id);
    
    $promociones = $sql_promo_prod->select('distinct(promocion_id) as promocion_id')
      ->where('pp.producto_id  IN ('.$sql_prods_pedido->getDql().')')
      ->execute();
        
    foreach ($promociones as $promocion) 
      $promos[] = Doctrine::getTable('Promocion')->find($promocion['promocion_id']);
        
    return $promos;
  }
  
  public function ControlarPromo($pid){
    $promocion = Doctrine::getTable('Promocion')->find($pid);
    $prods_requisito = $promocion->getProductos();
    foreach($prods_requisito as $prod) $prods_req[] = $prod->producto_id;
    $prods_pedido_cant = Doctrine_Query::create()
      ->select('sum(dp.cantidad) as cant_total')
      ->from('DetallePedido dp')
      ->whereIn('dp.producto_id', $prods_req)
      ->andwhere('dp.pedido_id = ?', $this->id)
      ->execute();
    if ($prods_pedido_cant[0]['cant_total'] >= $promocion->getTotalProdComprar())
      return true;
    else
      return false;
  }
  
  
}