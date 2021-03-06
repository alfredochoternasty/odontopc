<?php

/**
 * Venta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Venta extends BaseVenta
{
  public function __toString(){
    return $this->getNumero()." - ".$this->getFecha();
  }
  
  public function getSubTotal(){
    $suma = 0;
    foreach($this->getDetalle() as $det){
      $suma += $det->getSubtotal();
    }
    return $suma;    
  }
  
  public function getIva(){
    $suma = 0;
    foreach($this->getDetalle() as $det){
      $suma += $det->getIva();
    }
    return $suma;    
  }
  
  public function getTotal(){
    $suma = 0;
    foreach($this->getDetalle() as $det){
      $suma += $det->getTotal();
    }
    return $suma;    
  }
}