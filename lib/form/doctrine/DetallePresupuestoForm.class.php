<?php

/**
 * DetallePresupuesto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetallePresupuestoForm extends BaseDetallePresupuestoForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['presupuesto_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));
    
    $this->widgetSchema['descuento'] = new sfWidgetFormChoice(array('choices' => array(
			0 => 'Sin Descuento',
			5 => '5% de descuento',
			10 => '10% de descuento',
			15 => '15% de descuento',
			20 => '20% de descuento',
			25 => '25% de descuento',
			30 => '30% de descuento',
			35 => '35% de descuento',
			40 => '40% de descuento',
			45 => '45% de descuento',
			50 => '50% de descuento',
			55 => '55% de descuento',
			60 => '60% de descuento',
			65 => '65% de descuento',
			70 => '70% de descuento',
			75 => '75% de descuento',
			80 => '80% de descuento',
			85 => '85% de descuento',
			90 => '90% de descuento',
			95 => '95% de descuento',
			100 => '100% de descuento'
		)));
  }
}
