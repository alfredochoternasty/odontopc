<?php

class sfValidatorNroLote extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {

  }
 
  protected function doClean($value)
  {
    $query = Doctrine_Query::create()->select('count(*) as cant')->from ('DetalleCompra dc')->where('dc.nro_lote = ? ', $value);
    $datos = $query->execute();
    $cantidad_compra = $datos[0]['cant'];
    
    if($cantidad_compra > 0){
      $query = Doctrine_Query::create()->select('count(*) as cant')->from ('DetalleResumen dr')->where('dr.nro_lote = ? ', $value);
      $datos = $query->execute();
      $cantidad_venta = $datos[0]['cant'];
    
      if ($cantidad_venta <= $cantidad_compra){
        return true;
      }else{
        throw new sfValidatorError($this, 'Este nro de lote ya no tiene productos disponibles', array('value' => $value));
      }
    }else{
      throw new sfValidatorError($this, 'Nro de lote no válido', array('value' => $value));
    }
  }
 
}

?>