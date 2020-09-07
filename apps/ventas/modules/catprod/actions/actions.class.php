<?php

require_once dirname(__FILE__).'/../lib/catprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/catprodGeneratorHelper.class.php';

/**
 * catprod actions.
 *
 * @package    odontopc
 * @subpackage catprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class catprodActions extends autoCatprodActions
{
	public function executeListVerHistorico(sfWebRequest $request) {
		$this->ver_historico = true;
		$this->executeIndex($request);
		$this->setTemplate('index');
	}
	
	public function executeListVerActuales(sfWebRequest $request) {
		$this->ver_actuales = true;
		$this->zonas = Doctrine::getTable('Zona')->findAll();
		$this->executeIndex($request);
		$this->setTemplate('index');
	}
}
