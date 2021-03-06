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
		$this->widgetSchema ['saldo_mayor'] = new sfWidgetFormInputText();
		$this->validatorSchema ['saldo_mayor'] = new sfValidatorNumber(array('required' => false));
		
    $this->widgetSchema['ult_fec_cobro'] = new sfWidgetFormDateJQueryUI_NTI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['ult_fec_cobro'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false));

    $this->widgetSchema['ult_fec_venta'] = new sfWidgetFormDateJQueryUI_NTI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['ult_fec_venta'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false));
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));
  }
	
	public function getFields()
	{
		return array_merge(parent::getFields(), array('mayor' => 'Number', 'ult_cobro' => 'Date', 'ult_venta' => 'Date'));
	}	
	
	public function addSaldoMayorColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value) && is_numeric($value)) {
			$value = str_replace(array('.', ','), array('', ''), $value);
			$query->andWhere($rootAlias.'.saldo > '.$value);
		}
		return $query;
	}

	public function addUltFecCobroColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) $query->andWhere("$rootAlias.ult_cobro <= '$value'");
		return $query;
	}
	
	public function addUltFecVentaColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) $query->andWhere("$rootAlias.ult_venta <= '$value'");
		return $query;
	}	
}
