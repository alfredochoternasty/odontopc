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
		unset($this['cuit'], $this['fecha_nacimiento'], $this['domicilio'], $this['telefono'], $this['celular'], $this['fax'], $this['email'], $this['observacion']);

		$this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
		$this->widgetSchema['sexo'] = new sfWidgetFormChoice(array('choices' => array('M' => 'Masculino', 'F' => 'Femenino', 'J' => 'Persona Juridica')));

		$this->widgetSchema['moneda'] = new sfWidgetFormDoctrineChoice(array('model' => 'TipoMoneda', 'add_empty' => true));
		$this->validatorSchema['moneda'] = new sfValidatorPass(array('required' => false));
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'add_empty' => true));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));		
		
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));        
		
		//$this->validatorSchema->setOption('allow_extra_fields', true);
		//$this->validatorSchema->setOption('filter_extra_fields', false);			
	}
  
	public function addMonedaColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if ($values['text'] != '') {
			$query->andWhere("m.id = ?", $values['text']);
		}
	}  
	
	public function getFields()
	{
	  return parent::getFields() + array('Moneda' => 'Text');
	}

}

?>