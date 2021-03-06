<?php

/**
 * Grupoprod
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Grupoprod extends BaseGrupoprod
{
	public function __toString()
	{
		$val = $this->getNombre();
		return empty($val)? '' : $val;
	}
  
	public function getImagen()
	{
		if (!empty($this->getFoto())) {
			return $this->getFotoChica();
		} else {
			return 'no_img.png';
		}
	}
	
  public function getProductos() {
    $q = Doctrine_Core::getTable('Producto')
      ->createQuery('p')
      ->where('p.activo = 1')
      ->andWhere('p.grupoprod_id = ?', $this->getId())
      ->orderBy('p.orden_grupo ASC');
    return $q->execute();
  }
  
  public function CantidadFacturada(){
    $q = Doctrine_Query::create()
        ->select('sum(d.cantidad) as cant')
        ->from('DetalleVenta d')
        ->leftJoin('Producto p')
        ->where('p.grupoprod_id = ?', $this->getId());
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
        ->where('d.grupoprod_id = ?', $this->getId());
    $Comp = $q->execute();
    
    if($Comp[0]['cant'] == '')
      return 0;
    else
      return $Comp[0]['cant'];
  }
}