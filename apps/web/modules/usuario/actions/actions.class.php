<?php

require_once dirname(__FILE__).'/../lib/usuarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usuarioGeneratorHelper.class.php';

/**
 * usuario actions.
 *
 * @package    odontopc
 * @subpackage usuario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends autoUsuarioActions
{
	public function executeEdit(sfWebRequest $request)
  {
    $this->sf_guard_user = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->sf_guard_user);
		$this->setLayout('layout_app');
  }
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $sf_guard_user = $form->save();
			$this->getUser()->setFlash('notice', 'Clave cambiada correctamente');
			$this->redirect('usuario/edit?id='.$sf_guard_user->getId());
    }else{
      $this->getUser()->setFlash('error', 'No se pudo cambiar la clave', false);
    }
		$this->setLayout('layout_app');
  }
	
  public function executeUpdate(sfWebRequest $request)
  {
    $this->sf_guard_user = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->sf_guard_user);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
		$this->setLayout('layout_app');
  }
}
