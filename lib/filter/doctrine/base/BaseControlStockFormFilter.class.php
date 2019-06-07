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
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'nro_lote'       => new sfWidgetFormFilterInput(),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'comprados'      => new sfWidgetFormFilterInput(),
      'vendidos'       => new sfWidgetFormFilterInput(),
      'stock_guardado' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'producto_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'nro_lote'       => new sfValidatorPass(array('required' => false)),
      'zona_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'comprados'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vendidos'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_guardado' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'             => 'Number',
      'producto_id'    => 'ForeignKey',
      'grupoprod_id'   => 'ForeignKey',
      'nro_lote'       => 'Text',
      'zona_id'        => 'ForeignKey',
      'comprados'      => 'Number',
      'vendidos'       => 'Number',
      'stock_guardado' => 'Number',
    );
  }
}
