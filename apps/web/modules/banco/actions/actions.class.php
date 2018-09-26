<?php

require_once dirname(__FILE__).'/../lib/bancoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bancoGeneratorHelper.class.php';

/**
 * banco actions.
 *
 * @package    odontopc
 * @subpackage banco
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bancoActions extends autoBancoActions
{
	public function executeCargar(sfWebRequest $request){
    $this->form = new BancoForm();
    $this->banco = $this->form->getObject();    
    $this->setTemplate('new_banco');
  }
}
