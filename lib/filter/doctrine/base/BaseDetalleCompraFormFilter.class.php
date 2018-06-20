<?php

/**
 * DetalleCompra filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetalleCompraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'compra_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'       => new sfWidgetFormFilterInput(),
      'observacion' => new sfWidgetFormFilterInput(),
      'nro_lote'    => new sfWidgetFormFilterInput(),
      'fecha_vto'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'iva'         => new sfWidgetFormFilterInput(),
      'sub_total'   => new sfWidgetFormFilterInput(),
      'trazable'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'sin_vto'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'compra_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Compra'), 'column' => 'id')),
      'producto_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion' => new sfValidatorPass(array('required' => false)),
      'nro_lote'    => new sfValidatorPass(array('required' => false)),
      'fecha_vto'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'iva'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sub_total'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'trazable'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'sin_vto'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('detalle_compra_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleCompra';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'compra_id'   => 'ForeignKey',
      'producto_id' => 'ForeignKey',
      'precio'      => 'Number',
      'cantidad'    => 'Number',
      'total'       => 'Number',
      'observacion' => 'Text',
      'nro_lote'    => 'Text',
      'fecha_vto'   => 'Date',
      'iva'         => 'Number',
      'sub_total'   => 'Number',
      'trazable'    => 'Boolean',
      'usuario'     => 'ForeignKey',
      'sin_vto'     => 'Boolean',
    );
  }
}
