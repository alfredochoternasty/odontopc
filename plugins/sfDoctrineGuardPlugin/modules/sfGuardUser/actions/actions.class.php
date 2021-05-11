<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardUserActions extends autoSfGuardUserActions
{
	public function executeClave(sfWebRequest $request)
  {
    $this->sf_guard_user = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->sf_guard_user);
		$this->setLayout('layout');
  }
}
