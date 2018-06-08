<?php

class webConfiguration extends sfApplicationConfiguration
{
  public function configure(){
    $this->dispatcher->connect('detalle_resumen.save', array('Producto','DescontarStock'));
    $this->dispatcher->connect('detalle_compra.save', array('Producto','AumentarStock'));
    
    $this->dispatcher->connect('detalle_resumen.delete', array('Producto','AumentarStock'));
    $this->dispatcher->connect('detalle_compra.delete', array('Producto','DescontarStock'));    
  }
}
