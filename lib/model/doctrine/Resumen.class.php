<?php

/**
 * Resumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Resumen extends BaseResumen
{
  public function __toString()
  {
    return $this->getId();
  }

  public function SimboloMoneda(){
    return $this->getCliente()->getLista()->getMoneda()->getSimbolo();
  }
  
  public function getTotalResumen()
  {
    $suma = 0;
    foreach($this->getDetalle() as $det){
      $suma += $det->getTotal();
    }
    return $suma;
  }

  public function getTotalResumenFormato(){
    return sprintf($this->SimboloMoneda()." %01.2f", $this->getTotalResumen());
  }   
  
  public function getTotalFacturado(){
    return $this->getVenta()->getTotal();
  }
  
  public function getTotalCobrado(){
    $suma = 0;
    foreach($this->getCobroResumen() as $cobro){
      $suma += $cobro->getMonto();
    }
    return $suma;
  }
  
  public function getTotalGeneraComision(){
    $suma = 0;
    foreach($this->getDetalle() as $det){
      if(($det->getProducto()->getGeneraComision() == 1) && ($det->getCliente()->getGeneraComision() == 1))
        $suma += $det->getTotal();
    }
    return $suma;
  }
}