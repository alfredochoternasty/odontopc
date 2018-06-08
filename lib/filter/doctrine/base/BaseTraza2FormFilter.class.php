<?php

/**
 * Traza2 filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTraza2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto2'), 'add_empty' => true)),
      'nro_lote'      => new sfWidgetFormFilterInput(),
      'nro_venta'     => new sfWidgetFormFilterInput(),
      'fecha_venta'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cliente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'fecha_compra'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'proveedor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'numero_compra' => new sfWidgetFormFilterInput(),
      'cant_vendida'  => new sfWidgetFormFilterInput(),
      'cant_comprada' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'producto_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto2'), 'column' => 'id')),
      'nro_lote'      => new sfValidatorPass(array('required' => false)),
      'nro_venta'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_venta'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'fecha_compra'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'proveedor_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'numero_compra' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_vendida'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_comprada' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('traza2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Traza2';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'producto_id'   => 'ForeignKey',
      'nro_lote'      => 'Text',
      'nro_venta'     => 'Number',
      'fecha_venta'   => 'Date',
      'cliente_id'    => 'ForeignKey',
      'fecha_compra'  => 'Date',
      'proveedor_id'  => 'ForeignKey',
      'numero_compra' => 'Number',
      'cant_vendida'  => 'Number',
      'cant_comprada' => 'Number',
    );
  }
}
