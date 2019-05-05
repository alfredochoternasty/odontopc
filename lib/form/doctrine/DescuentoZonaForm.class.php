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
		
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
		
    $this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true));
    $this->validatorSchema['zona_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id'));
  }
}
