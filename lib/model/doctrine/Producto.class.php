<?php

/**
 * Producto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Producto extends BaseProducto
{
	public function __toString()
	{
		$val = $this->getNombre();
		return empty($val)? '' : $val;
	}
  
  public static function DescontarStock(sfEvent $event){
    $prod = $event['object']->getProductoId();
    $cant_vta = $event['object']->getCantidad();
    $lote = $event['object']->getNroLote();
    
    if(isset($event['object']->bonificados)){
      $cant_bono = $event['object']->getBonificados();
    }else{
      $cant_bono = 0;
    }
    
    $prods = Doctrine::getTable('Lote')->findByProductoIdAndNroLote($prod, $lote);
    foreach($prods as $producto){
      $cant_prod = $producto->getStock();
    }
    
    $q = Doctrine_Query::create()
        ->update('lote l')
        ->set('l.stock', '?', $cant_prod - $cant_vta - $cant_bono)
        ->where('l.producto_id = ?', $prod)
        ->andWhere('l.nro_lote = ?', $lote);
    $q->execute();    
  }

  public static function AumentarStock(sfEvent $event){
    $prod = $event['object']->getProductoId();
    $cant_cmp = $event['object']->getCantidad();
    $lote = $event['object']->getNroLote();
    
    $prods = Doctrine::getTable('Lote')->findByProductoIdAndNroLote($prod, $lote);
    $cant_prod = null;
    foreach($prods as $producto){
      $cant_prod = $producto->getStock();
    }
 
    if(empty($cant_prod)){
      try{
        $fec_vto = $event['object']->getFechaVto();
        $compra = $event['object']->getCompraId();
      }catch(Exception $e){
        $fec_vto = null;
        $compra = null;
      }      
    
      $obj_lote = new Lote();
      $obj_lote->setProductoId($prod);
      $obj_lote->setNroLote($lote);
      $obj_lote->setStock($cant_cmp);
      $obj_lote->setFechaVto($fec_vto);
      $obj_lote->setCompraId($compra);
      $obj_lote->save();
    }else{    
      $q = Doctrine_Query::create()
          ->update('lote l')
          ->set('l.stock', '?', $cant_prod + $cant_cmp)
          ->where('l.producto_id = ?', $prod)
          ->andWhere('l.nro_lote = ?', $lote);
      $q->execute();    
    }
  }
  
  public function CantidadFacturada(){
    $q = Doctrine_Query::create()
        ->select('sum(d.cantidad) as cant')
        ->from('DetalleVenta d')
        ->where('d.producto_id = ?', $this->getId());
    $fact = $q->execute();

    if($fact[0]['cant'] == '')
      return 0;
    else
      return $fact[0]['cant'];
  }
  
  public function CantidadComprada(){
    $q = Doctrine_Query::create()
        ->select('sum(d.cantidad) as cant')
        ->from('DetFactCompra d')
        ->where('d.producto_id = ?', $this->getId());
    $Comp = $q->execute();

    if($Comp[0]['cant'] == '')
      return 0;
    else
      return $Comp[0]['cant'];
  }  
  
  public function getPrecioFinal($p_lis){
    return Doctrine::getTable('ListaPrecio')->find($p_lis)->getPrecioLista($this->getId(), $this->getPrecioVta());
  }
   
}