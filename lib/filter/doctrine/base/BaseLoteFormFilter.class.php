<?php

/**
 * Lote filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLoteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'nro_lote'    => new sfWidgetFormFilterInput(),
      'stock'       => new sfWidgetFormFilterInput(),
      'fecha_vto'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'compra_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'observacion' => new sfWidgetFormFilterInput(),
      'usuario_id'  => new sfWidgetFormFilterInput(),
      'zona_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'activo'      => new sfWidgetFormFilterInput(),
      'externo'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'producto_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'nro_lote'    => new sfValidatorPass(array('required' => false)),
      'stock'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_vto'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'compra_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Compra'), 'column' => 'id')),
      'observacion' => new sfValidatorPass(array('required' => false)),
      'usuario_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'zona_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'activo'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'externo'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lote';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'producto_id' => 'ForeignKey',
      'nro_lote'    => 'Text',
      'stock'       => 'Number',
      'fecha_vto'   => 'Date',
      'compra_id'   => 'ForeignKey',
      'observacion' => 'Text',
      'usuario_id'  => 'Number',
      'zona_id'     => 'ForeignKey',
      'activo'      => 'Number',
      'externo'     => 'Number',
    );
  }
}
