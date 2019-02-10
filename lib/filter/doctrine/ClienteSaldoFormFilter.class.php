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
	/*
	public function getFields()
	{
		return array_merge(parent::getFields(), array('mayor' => 'Number'));
	}	
	*/
	public function addMayorQuery($query, $field, $value)
	{
		//return Doctrine::getTable('ClienteSaldo')->applyMayorFilter($query, $value);
    $rootAlias = $query->getRootAlias();
    $query->andWhere($rootAlias.'.saldo > '.$value);
    return $query;		
	}
	
}
