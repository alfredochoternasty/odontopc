<?php

/**
 * Promocion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Promocion extends BasePromocion
{
	
	public function ProductoEnPromocion($pid)
	{
		$prod_promo = Doctrine::getTable('PromocionRegalo')->findByPromocionIdAndProductoId($this->id, $pid);
		if (!empty($prod_promo)) 
			return true;
		else
			return false;
	}
}