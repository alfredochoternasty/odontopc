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

}
