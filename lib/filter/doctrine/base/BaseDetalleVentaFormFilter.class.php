<?php

/**
 * DetalleVenta filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetalleVentaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'venta_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subtotal'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iva'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'       => new sfWidgetFormFilterInput(),
      'observacion' => new sfWidgetFormFilterInput(),
      'nro_lote'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'venta_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'producto_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subtotal'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'iva'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion' => new sfValidatorPass(array('required' => false)),
      'nro_lote'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_venta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleVenta';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'venta_id'    => 'Number',
      'producto_id' => 'ForeignKey',
      'precio'      => 'Number',
      'cantidad'    => 'Number',
      'subtotal'    => 'Number',
      'iva'         => 'Number',
      'total'       => 'Number',
      'observacion' => 'Text',
      'nro_lote'    => 'Text',
    );
  }
}
