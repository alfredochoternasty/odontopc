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
    
		if (!empty($event['object']->resumen_id)) {
			$zona = $event['object']->getResumen()->getCliente()->getZonaId(); //venta
		} else {
			$zona = $event['object']->getCompra()->getZonaId(); //compra - borrar
		}		
    
    if(isset($event['object']->bonificados)){
      $cant_bono = $event['object']->getBonificados();
    }else{
      $cant_bono = 0;
    }
    
    $prods = Doctrine::getTable('Lote')->findByProductoIdAndNroLoteAndZonaId($prod, $lote, $zona);
    foreach($prods as $producto){
      $cant_prod = $producto->getStock();
    }
    
    $q = Doctrine_Query::create()
        ->update('lote l')
        ->set('l.stock', '?', $cant_prod - $cant_vta - $cant_bono)
        ->where('l.producto_id = ?', $prod)
        ->andWhere('l.nro_lote = ?', $lote)
        ->andWhere('l.zona_id = ?', $zona);
    $q->execute();    
  }

  public static function AumentarStock(sfEvent $event){
    $prod = $event['object']->getProductoId();
    $lote = $event['object']->getNroLote();
		if (!empty($event['object']->compra_id)) {
			$zona = $event['object']->getCompra()->zona_id; //compra
		} elseif (!empty($event['object']->resumen_id)) {
			$zona = $event['object']->getResumen()->getCliente()->zona_id; // venta - borrar
		} else {
			$zona = $event['object']->getCliente()->zona_id; //devolucion
		}
    
    $prods = Doctrine::getTable('Lote')->findByProductoIdAndNroLoteAndZonaId($prod, $lote, $zona);
    $cant_prod = null;
		
		if (!empty($prods[0])) {
			$lote = Doctrine::getTable('Lote')->find($prods[0]->id);
			if (!empty($event['object']->bonificados)) {
				$lote->stock += $event['object']->cantidad + $event['object']->bonificados;
			} else {
				$lote->stock += $event['object']->cantidad;
			}
			$lote->save();
		} else {
      $obj_lote = new Lote();
      $obj_lote->setProductoId($prod);
      $obj_lote->setNroLote($lote);
      $obj_lote->setStock($event['object']->cantidad);
      $obj_lote->setFechaVto($event['object']->fecha_vto);
      $obj_lote->setCompraId($event['object']->compra_id);
      $obj_lote->setUsuario($event['object']->usuario);
      $obj_lote->setZonaId($event['object']->getCompra()->zona_id);
      $obj_lote->save();			
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
		$prod_lista = $this->getListaId();
		if (!empty($prod_lista)) {
			$p_lis = $prod_lista;
		} 

		return Doctrine::getTable('ListaPrecio')->find($p_lis)->getPrecioLista($this->getId(), $this->getPrecioVta());
  }
   
}