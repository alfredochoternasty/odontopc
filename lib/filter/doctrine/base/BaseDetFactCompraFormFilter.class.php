<?php

/**
 * DetFactCompra filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetFactCompraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'factcompra_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Factura'), 'add_empty' => true)),
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupoprod'), 'add_empty' => true)),
      'precio'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subtotal'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iva'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'         => new sfWidgetFormFilterInput(),
      'nro_lote'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'factcompra_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Factura'), 'column' => 'id')),
      'producto_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupoprod'), 'column' => 'id')),
      'precio'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subtotal'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'iva'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nro_lote'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('det_fact_compra_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetFactCompra';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'factcompra_id' => 'ForeignKey',
      'producto_id'   => 'ForeignKey',
      'grupoprod_id'  => 'ForeignKey',
      'precio'        => 'Number',
      'cantidad'      => 'Number',
      'subtotal'      => 'Number',
      'iva'           => 'Number',
      'total'         => 'Number',
      'nro_lote'      => 'Text',
    );
  }
}
