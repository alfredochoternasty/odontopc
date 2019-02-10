<?php

/**
 * DetalleResumen filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetalleResumenFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'resumen_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'producto_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bonificados'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observacion'      => new sfWidgetFormFilterInput(),
      'nro_lote'         => new sfWidgetFormFilterInput(),
      'fecha_vto'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'iva'              => new sfWidgetFormFilterInput(),
      'sub_total'        => new sfWidgetFormFilterInput(),
      'usuario'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'lista_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'moneda_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'cant_vend_remito' => new sfWidgetFormFilterInput(),
      'lote_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'resumen_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'producto_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'bonificados'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observacion'      => new sfValidatorPass(array('required' => false)),
      'nro_lote'         => new sfValidatorPass(array('required' => false)),
      'fecha_vto'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'iva'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sub_total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'usuario'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'lista_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'moneda_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'cant_vend_remito' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lote_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lote'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('detalle_resumen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleResumen';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'resumen_id'       => 'ForeignKey',
      'producto_id'      => 'ForeignKey',
      'precio'           => 'Number',
      'cantidad'         => 'Number',
      'total'            => 'Number',
      'bonificados'      => 'Number',
      'observacion'      => 'Text',
      'nro_lote'         => 'Text',
      'fecha_vto'        => 'Date',
      'iva'              => 'Number',
      'sub_total'        => 'Number',
      'usuario'          => 'ForeignKey',
      'lista_id'         => 'ForeignKey',
      'moneda_id'        => 'ForeignKey',
      'cant_vend_remito' => 'Number',
      'lote_id'          => 'ForeignKey',
    );
  }
}
