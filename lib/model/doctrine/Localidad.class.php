<?php

/**
 * Localidad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Localidad extends BaseLocalidad
{
	public function __toString()
	{
		$val = $this->getNombre();
		return empty($val)? '' : $val;
	}
  
  public function getLocConProvincia()
  {
        return $this->getProvincia().' - '.$this->getNombre();
  }  
}