<?php

/**
 * Producto2
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Producto2 extends BaseProducto2
{
	public function __toString()
	{
		$val = $this->getCodigo() .' - '.$this->getNombre();
		return empty($val)? '' : $val;
	}
}