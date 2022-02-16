<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}
/**
 * CobroResumen filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CobroResumenFormFilter extends BaseCobroResumenFormFilter
{
  public function configure()
  {
    parent::configure();
    
		$this->widgetSchema ['nro_cobro'] = new sfWidgetFormInputText();
		$this->validatorSchema ['nro_cobro'] = new sfValidatorNumber(array('required' => false));
    
		$this->widgetSchema ['nro_factura'] = new sfWidgetFormInputText();
		$this->validatorSchema ['nro_factura'] = new sfValidatorNumber(array('required' => false));
		
		$this->widgetSchema ['cobro_id'] = new sfWidgetFormInputText();
		$this->validatorSchema ['cobro_id'] = new sfValidatorNumber(array('required' => false));
    
		$this->widgetSchema ['resumen_id'] = new sfWidgetFormInputText();
		$this->validatorSchema ['resumen_id'] = new sfValidatorNumber(array('required' => false));
  }

	public function addNroCobroColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) {
      $query->leftJoin("$rootAlias.Cobro cob");
      $query->andWhere("cob.nro_recibo = $value");
    }
		return $query;
	}
	
	public function addNroFacturaColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) {
      $query->leftJoin("$rootAlias.Resumen res");
      $query->andWhere("res.nro_factura = $value");
    }
		return $query;
	}	
	
	public function addResumenIdColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) $query->andWhere("$rootAlias.resumen_id = $value");
		return $query;
	}
	
	public function addCobroIdColumnQuery($query, $field, $value)
	{
    $rootAlias = $query->getRootAlias();
		if (!empty($value)) $query->andWhere("$rootAlias.cobro_id = $value");
		return $query;
	}
}
