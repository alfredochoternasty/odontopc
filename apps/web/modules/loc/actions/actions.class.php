<?php

require_once dirname(__FILE__).'/../lib/locGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/locGeneratorHelper.class.php';

/**
 * loc actions.
 *
 * @package    odontopc
 * @subpackage loc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locActions extends autoLocActions
{
  public function executeCargar(sfWebRequest $request){
    $this->form = new LocalidadForm();
    $this->localidad = $this->form->getObject();    
    $this->setTemplate('new_loc');
  }
}
