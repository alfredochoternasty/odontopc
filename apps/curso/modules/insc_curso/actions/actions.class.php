<?php

require_once dirname(__FILE__).'/../lib/insc_cursoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/insc_cursoGeneratorHelper.class.php';

/**
 * insc_curso actions.
 *
 * @package    odontopc
 * @subpackage insc_curso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class insc_cursoActions extends autoInsc_cursoActions
{
  
  public function executeNew(sfWebRequest $request)
  {
    if ($request->getParameter('cid')) {
      $this->curso = Doctrine::getTable('Curso')->find($request->getParameter('cid'));
      $datos = array('curso_id' => $this->curso->id, 'zona_id' => $this->zona_id);
      $this->form = $this->configuration->getForm(null, $datos);
      $this->curso_inscripcion = $this->form->getObject();
    } else {
      $this->redirect('@homepage');
    }
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@homepage');
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $curso_inscripcion = $form->save();
      $this->getUser()->setFlash('notice', 'Inscripción exitosa!');
      $this->redirect('@homepage');
    }else{
      $this->getUser()->setFlash('error', 'Error en la inscripción', false);
    }
  }
  
}
