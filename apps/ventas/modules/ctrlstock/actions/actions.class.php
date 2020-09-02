<?php

require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorHelper.class.php';

/**
 * ctrlstock actions.
 *
 * @package    odontopc
 * @subpackage ctrlstock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctrlstockActions extends autoCtrlstockActions
{
	
  public function getModoImpresion()
  {
    return 'landscape';
  }
  
}
