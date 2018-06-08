<?php

require_once dirname(__FILE__).'/../lib/ultcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ultcompGeneratorHelper.class.php';

/**
 * ultcomp actions.
 *
 * @package    odontopc
 * @subpackage ultcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ultcompActions extends autoUltcompActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'ultcompdet/index?rid='.$this->getRequestParameter('id'));
  }
 
}
