<?php

/**
 * Lote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Lote extends BaseLote
{
	public function __toString()
	{
		$val = $this->getStock();
		return empty($val)? 'no tiene' : $val;
	}
}