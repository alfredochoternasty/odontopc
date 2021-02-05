<?php

/**
 * Presupuesto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PresupuestoForm extends BasePresupuestoForm
{
  public function configure()
  {
    parent::configure();
		$zona_id = $this->getOption('zona_id');
		unset($this['vendido'], $this['fecha_venta'], $this['usuario_id']);
		
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivosVta', 'method' => 'getDescAfip', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))); 
		
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea();
    $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('size' => 70));
    $this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
		$this->setDefault('zona_id', $zona_id);
    
		if ($zona_id != 1) {
			$this->widgetSchema['lista_id'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['lista_id'] =  new sfValidatorInteger();
			$this->setDefault('lista_id', 1);
		} else {
			$this->widgetSchema['lista_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false));			
			$this->validatorSchema['lista_id'] =  new sfValidatorInteger(array('required' => false));
		}
  }
}
