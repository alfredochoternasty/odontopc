<?php

require_once dirname(__FILE__).'/../lib/cursoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cursoGeneratorHelper.class.php';

/**
 * curso actions.
 *
 * @package    odontopc
 * @subpackage curso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursoActions extends autoCursoActions
{
  public function executeListInscriptos(sfWebRequest $request){
    $this->redirect('insccurso/index?cid='.$this->getRequestParameter('id'));
  }

  public function executeListEnviar(sfWebRequest $request){
		$this->redirect('cursmail/new?cid='.$this->getRequestParameter('id'));
  }	
	
  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort'))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    // has filters? (usefull for activate reset button)
    $this->hasFilters = $this->getUser()->getAttribute('curso.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->curso = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->curso);
	if ($this->curso->hayActivos()) {
		$this->getUser()->setFlash('error', 'Cuidado hay otro curso activo, al guardar este desactivara los demas.');
	}
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->curso = $this->form->getObject();
	if ($this->curso->hayActivos()) {
		$this->getUser()->setFlash('error', 'Cuidado hay otro curso activo, al guardar este desactivara los demas.');
	}
  }
    
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $curso = $form->save();
      $curso->DesactivarOtros();
	  
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $curso)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@curso_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $curso->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'curso_edit', 'sf_subject' => $curso));
          $this->redirect('@curso');
        }
      }
	  
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
