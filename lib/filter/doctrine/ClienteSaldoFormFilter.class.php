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
		$this->widgetSchema ['mayor'] = new sfWidgetFormInputText();
		$this->validatorSchema ['mayor'] = new sfValidatorString();
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));
		
		$this->setDefault('mayor', '0');
  }
	
	public function getFields()
	{
		return array_merge(parent::getFields(), array('mayor' => 'Number'));
	}	
	
	public function addMayorColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value) && is_numeric($value)) {
			$value = str_replace(array('.', ','), array('', ''), $value);
			$query->andWhere($rootAlias.'.saldo > '.$value);
		}
		return $query;
	}
	
}
