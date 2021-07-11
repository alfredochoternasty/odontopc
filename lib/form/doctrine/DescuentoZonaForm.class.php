<?php

/**
 * DescuentoZona form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DescuentoZonaForm extends BaseDescuentoZonaForm
{
  public function configure()
  {
		parent::setup();

		$this->widgetSchema['operacion'] = new sfWidgetFormChoice(array('choices' => array('' => 'Seleccione una Opcion', 'cliente' => 'Por cliente', 'grupo' => 'Por grupo de productos', 'producto' => 'Por producto')));
		
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivosListado', 'add_empty' => true), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id'));
		
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
		
    $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupoprod'), 'table_method' => 'getGruposActivos', 'add_empty' => true));
    $this->validatorSchema['grupoprod_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupoprod'), 'column' => 'id'));
		
    $this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true));
    $this->validatorSchema['zona_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id'));
		
		$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}
