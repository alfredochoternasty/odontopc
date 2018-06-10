<?php

/**
 * compra2 filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basecompra2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero_compra' => new sfWidgetFormFilterInput(),
      'proveedor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto2'), 'add_empty' => true)),
      'cantidad'      => new sfWidgetFormFilterInput(),
      'nro_lote'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'numero_compra' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'proveedor_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'producto_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto2'), 'column' => 'id')),
      'cantidad'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nro_lote'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('compra2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'compra2';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'numero_compra' => 'Number',
      'proveedor_id'  => 'ForeignKey',
      'fecha'         => 'Date',
      'producto_id'   => 'ForeignKey',
      'cantidad'      => 'Number',
      'nro_lote'      => 'Text',
    );
  }
}
