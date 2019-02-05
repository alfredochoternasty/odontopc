<?php

/**
 * ClienteSaldo filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteSaldoFormFilter extends BaseClienteSaldoFormFilter
{
  public function configure()
  {
		parent::configure();
		$this->widgetSchema ['mayor'] = new sfWidgetFormInputText();
		$this->validatorSchema ['mayor'] = new sfValidatorNumber();
  }
	
	public function getFields()
	{
		$fields = parent::getFields();
		$fields['mayor'] = 'mayor';
		return $fields;
	}	
	
	public function addMayorColumnQuery($query, $field, $value)
	{
		Doctrine::getTable('ClienteSaldo')->applyMayorFilter($query, $value);
	}
}
