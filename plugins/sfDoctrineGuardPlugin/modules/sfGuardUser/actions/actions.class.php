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

  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $sf_guard_user = $form->save();
			$this->getUser()->setFlash('notice', 'Clave cambiada correctamente');
			$this->redirect('@homepage');
    }else{
      $this->getUser()->setFlash('error', 'No se pudo cambiar la clave', false);
    }
		$this->setLayout('layout');
  }
	
  public function executeUpdate(sfWebRequest $request)
  {
    $this->sf_guard_user = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->sf_guard_user);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
		$this->setLayout('layout');
  }
}
