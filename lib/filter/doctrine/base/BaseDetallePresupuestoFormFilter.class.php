<?php

/**
 * DetallePresupuesto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetallePresupuestoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'presupuesto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'), 'add_empty' => true)),
      'producto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'cantidad'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'          => new sfWidgetFormFilterInput(),
      'total'           => new sfWidgetFormFilterInput(),
      'iva'             => new sfWidgetFormFilterInput(),
      'descuento'       => new sfWidgetFormFilterInput(),
      'sub_total'       => new sfWidgetFormFilterInput(),
      'observacion'     => new sfWidgetFormFilterInput(),
      'nro_lote'        => new sfWidgetFormFilterInput(),
      'asignacion_lote' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'presupuesto_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Presupuesto'), 'column' => 'id')),
      'producto_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'cantidad'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'iva'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descuento'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sub_total'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion'     => new sfValidatorPass(array('required' => false)),
      'nro_lote'        => new sfValidatorPass(array('required' => false)),
      'asignacion_lote' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_presupuesto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetallePresupuesto';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'presupuesto_id'  => 'ForeignKey',
      'producto_id'     => 'ForeignKey',
      'cantidad'        => 'Number',
      'precio'          => 'Number',
      'total'           => 'Number',
      'iva'             => 'Number',
      'descuento'       => 'Number',
      'sub_total'       => 'Number',
      'observacion'     => 'Text',
      'nro_lote'        => 'Text',
      'asignacion_lote' => 'Text',
    );
  }
}
