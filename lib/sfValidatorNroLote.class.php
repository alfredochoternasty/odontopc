<?php

class sfValidatorNroLote extends sfValidatorBase
{
  protected function doClean($value)
  {
    $query = Doctrine_Query::create()->select('stock as cant')->from ('Lote l')->where('l.nro_lote = ? ', $value);
    $datos = $query->execute();
    $cantidad_compra = $datos[0]['cant'];
    
    if($cantidad_compra > 0){
        return $value;
    }else{
      throw new sfValidatorError($this, 'Nro de lote no válido', array('value' => $value));
    }
  }
}

?>