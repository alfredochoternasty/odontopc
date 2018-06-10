<?php

/**
 * ProductoTraza filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoTrazaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'codigo'        => new sfWidgetFormFilterInput(),
      'nro_lote'      => new sfWidgetFormFilterInput(),
      'fecha_vto'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nro_venta'     => new sfWidgetFormFilterInput(),
      'fecha_venta'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cliente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'fecha_compra'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'proveedor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'numero'        => new sfWidgetFormFilterInput(),
      'cant_vendida'  => new sfWidgetFormFilterInput(),
      'cant_comprada' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'producto_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'codigo'        => new sfValidatorPass(array('required' => false)),
      'nro_lote'      => new sfValidatorPass(array('required' => false)),
      'fecha_vto'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nro_venta'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_venta'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'fecha_compra'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'proveedor_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'numero'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_vendida'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_comprada' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('producto_traza_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoTraza';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'producto_id'   => 'ForeignKey',
      'codigo'        => 'Text',
      'nro_lote'      => 'Text',
      'fecha_vto'     => 'Date',
      'nro_venta'     => 'Number',
      'fecha_venta'   => 'Date',
      'cliente_id'    => 'ForeignKey',
      'fecha_compra'  => 'Date',
      'proveedor_id'  => 'ForeignKey',
      'numero'        => 'Number',
      'cant_vendida'  => 'Number',
      'cant_comprada' => 'Number',
    );
  }
}