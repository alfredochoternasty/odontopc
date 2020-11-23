<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * Cliente filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteFormFilter extends BaseClienteFormFilter
{
	public function configure()
	{
		$this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Localidad', 'add_empty' => true), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
		$this->validatorSchema['localidad_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id'));
		
		$this->widgetSchema['provincia_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Provincia', 'add_empty' => true), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
		$this->validatorSchema['provincia_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Provincia', 'column' => 'id'));
		
		$this->widgetSchema['sexo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'Masculino', 'F' => 'Femenino', 'J' => 'Persona Juridica')));
		$this->validatorSchema['sexo'] = new sfValidatorPass(array('required' => false));
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));
		
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
		
    $this->widgetSchema['fecha_alta'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hasta %to_date%'));
    $this->validatorSchema['fecha_alta'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));
		
	}	
	
	public function getFields()
	{
		return array_merge(parent::getFields(), array('provincia_id' => 'Number'));
	}	
	
	public function addProvinciaIdColumnQuery($query, $field, $value)
	{
		if (!empty($value) && is_numeric($value)) {
			$query->andWhere('l.provincia_id = '.$value);
		}
		return $query;
	}

}

?>