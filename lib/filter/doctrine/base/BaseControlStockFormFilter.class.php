<?php

/**
 * ControlStock filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseControlStockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'producto_nombre' => new sfWidgetFormFilterInput(),
      'nro_lote'        => new sfWidgetFormFilterInput(),
      'cant_comprada'   => new sfWidgetFormFilterInput(),
      'cant_vendida'    => new sfWidgetFormFilterInput(),
      'stock'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'producto_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'producto_nombre' => new sfValidatorPass(array('required' => false)),
      'nro_lote'        => new sfValidatorPass(array('required' => false)),
      'cant_comprada'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_vendida'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('control_stock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ControlStock';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'grupoprod_id'    => 'ForeignKey',
      'producto_id'     => 'ForeignKey',
      'producto_nombre' => 'Text',
      'nro_lote'        => 'Text',
      'cant_comprada'   => 'Number',
      'cant_vendida'    => 'Number',
      'stock'           => 'Number',
    );
  }
}
