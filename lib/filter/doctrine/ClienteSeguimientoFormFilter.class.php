<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * ClienteSeguimiento filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteSeguimientoFormFilter extends BaseClienteSeguimientoFormFilter
{
  public function configure()
  {
		/*
		parent::configure();
		
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))); 
		
    $this->widgetSchema['tipo_contacto_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'TipoContacto', 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));        
		$this->validatorSchema['tipo_contacto_id'] = new sfValidatorInteger();		
		
    $this->widgetSchema['tipo_respuesta_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'TipoRespuesta', 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));        
		$this->validatorSchema['tipo_respuesta_id'] = new sfValidatorInteger();		
		
    $this->widgetSchema['prox_contac_tiempo'] = new sfWidgetFormDoctrineChoice(array('model' => 'TipoTiempoContac', 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));        
		$this->validatorSchema['prox_contac_tiempo'] = new sfValidatorInteger();		

    $this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
    $this->widgetSchema['prox_contac_fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
		
		
    $this->widgetSchema['realizada'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['realizada'] = new sfValidatorInteger();
		
    $this->widgetSchema['motivo_id'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['motivo_id'] = new sfValidatorInteger();
		*/
  }

}
