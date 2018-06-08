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
      'producto_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_nombre'      => new sfWidgetFormFilterInput(),
      'resumen_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'fecha_vta'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nro_lote'             => new sfWidgetFormFilterInput(),
      'cantidad_vendida'     => new sfWidgetFormFilterInput(),
      'cantidad_bonificados' => new sfWidgetFormFilterInput(),
      'cantidad_total'       => new sfWidgetFormFilterInput(),
      'stock_actual'         => new sfWidgetFormFilterInput(),
      'stock_sin_lote'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'grupo2'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'producto_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'producto_nombre'      => new sfValidatorPass(array('required' => false)),
      'resumen_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'fecha_vta'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nro_lote'             => new sfValidatorPass(array('required' => false)),
      'cantidad_vendida'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad_bonificados' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad_total'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_actual'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_sin_lote'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'grupo2'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoDos'), 'column' => 'id')),
      'grupo3'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoTres'), 'column' => 'id')),
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
      'id'                   => 'Number',
      'producto_id'          => 'ForeignKey',
      'grupoprod_id'         => 'ForeignKey',
      'producto_nombre'      => 'Text',
      'resumen_id'           => 'ForeignKey',
      'fecha_vta'            => 'Date',
      'nro_lote'             => 'Text',
      'cantidad_vendida'     => 'Number',
      'cantidad_bonificados' => 'Number',
      'cantidad_total'       => 'Number',
      'stock_actual'         => 'Number',
      'stock_sin_lote'       => 'Date',
      'grupo2'               => 'ForeignKey',
      'grupo3'               => 'ForeignKey',
    );
  }
}
