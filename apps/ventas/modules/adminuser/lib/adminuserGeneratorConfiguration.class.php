<?php

/**
 * adminuser module configuration.
 *
 * @package    odontopc
 * @subpackage adminuser
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adminuserGeneratorConfiguration extends BaseAdminuserGeneratorConfiguration
{
	public function getFilterDefaults()
	{    
			return array('es_cliente' => '0');
	}	
}
