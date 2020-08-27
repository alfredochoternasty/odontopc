<?php

require_once dirname(__FILE__).'/../lib/pedvendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pedvendGeneratorHelper.class.php';

/**
 * pedvend actions.
 *
 * @package    odontopc
 * @subpackage pedvend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pedvendActions extends autoPedvendActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detpedidos/index?pid='.$this->getRequestParameter('id'));
  }
}
