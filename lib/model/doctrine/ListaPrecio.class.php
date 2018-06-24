<?php

/**
 * ListaPrecio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ListaPrecio extends BaseListaPrecio
{
	public function __toString()
	{
		$val = $this->getNombre();
		return empty($val)? '' : $val;
	}
  
  public function getPrecioLista($p_pid, $p_precio_vta){
    //busco precios para el producto
    $detlis = Doctrine::getTable('DetLisPrecio')->findByListaIdAndProductoId($this->getId(), $p_pid);
    if($detlis[0] == ''){//si no hay precio definido para ese producto, busco para su grupo
      $objprod = Doctrine::getTable('Producto')->find($p_pid);
      $detlis = Doctrine::getTable('DetLisPrecio')->findByListaIdAndGrupoprodId($this->getId(), $objprod->getGrupoprodId());
    }
    
    if($detlis[0] != ''){// aca viene con el objeto del producto o si no tiene, con el del grupo.
      $precio_real = $detlis[0]->getPrecioDetLista($p_precio_vta); // si la lista tiene detalle definido, ya se para el grupo o producto, buscal predio de ahi
    }elseif($this->getPrecio() != ''){
      $precio_real = $this->getPrecio();
    }elseif($this->getAumento() != ''){
      $aumento = ($this->getAumento()*$p_precio_vta)/100;
      $precio_real = $p_precio_vta + $aumento;
      echo  json_encode($precio_real);
    }elseif($this->getDescuento() != ''){
      $descuento = ($this->getDescuento()*$p_precio_vta)/100;
      $precio_real = $p_precio_vta - $descuento;
    }else{
      $precio_real = $p_precio_vta;
    }
    
    return $precio_real.'##'.$this->getMoneda();
  }  
}