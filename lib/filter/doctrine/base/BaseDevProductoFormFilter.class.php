<?php

/**
 * DevProducto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDevProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'resumen_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'cantidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'      => new sfWidgetFormFilterInput(),
      'total'       => new sfWidgetFormFilterInput(),
      'observacion' => new sfWidgetFormFilterInput(),
      'nro_lote'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'resumen_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'producto_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'cantidad'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion' => new sfValidatorPass(array('required' => false)),
      'nro_lote'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dev_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DevProducto';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fecha'       => 'Date',
      'cliente_id'  => 'ForeignKey',
      'resumen_id'  => 'ForeignKey',
      'producto_id' => 'ForeignKey',
      'cantidad'    => 'Number',
      'precio'      => 'Number',
      'total'       => 'Number',
      'observacion' => 'Text',
      'nro_lote'    => 'Text',
    );
  }
}
