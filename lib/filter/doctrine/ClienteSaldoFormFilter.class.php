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
		//parent::configure();
		$this->widgetSchema ['apellido'] = new sfWidgetFormInputText();
		$this->validatorSchema ['apellido'] = new sfValidatorString();		
		
		$this->widgetSchema ['mayor'] = new sfWidgetFormInputText();
		$this->validatorSchema ['mayor'] = new sfValidatorString();
		
		$this->setDefault('mayor', '0');
  }
	
	public function getFields()
	{
		return array_merge(parent::getFields(), array('mayor' => 'Number'));
	}	
	
	public function addMayorColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		$value = (empty($value)|| !is_numeric($value))? 0 : str_replace(array('.', ','), array('', ''), $value);
    $query->andWhere($rootAlias.'.saldo > '.$value);
    return $query;		
	}
	
}
