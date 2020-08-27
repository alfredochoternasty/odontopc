<?php

/**
 * cli module configuration.
 *
 * @package    odontopc
 * @subpackage cli
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cliGeneratorConfiguration extends BaseCliGeneratorConfiguration
{
	public function getFilterDefaults()
	{    
			return array('activo' => 1);
	}	
}
