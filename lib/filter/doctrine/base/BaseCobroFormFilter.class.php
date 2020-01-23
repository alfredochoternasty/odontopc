<?php

/**
 * Cobro filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCobroFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'resumen_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'moneda_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'monto'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'banco_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true)),
      'numero'      => new sfWidgetFormFilterInput(),
      'fecha_vto'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'devprod_id'  => new sfWidgetFormFilterInput(),
      'observacion' => new sfWidgetFormFilterInput(),
      'usuario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'nro_recibo'  => new sfWidgetFormFilterInput(),
      'zona_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'archivo'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'resumen_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'moneda_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'monto'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'banco_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Banco'), 'column' => 'id')),
      'numero'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_vto'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'devprod_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observacion' => new sfValidatorPass(array('required' => false)),
      'usuario'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'nro_recibo'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'zona_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'archivo'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cobro_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cobro';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fecha'       => 'Date',
      'cliente_id'  => 'ForeignKey',
      'resumen_id'  => 'ForeignKey',
      'moneda_id'   => 'ForeignKey',
      'monto'       => 'Number',
      'tipo_id'     => 'ForeignKey',
      'banco_id'    => 'ForeignKey',
      'numero'      => 'Number',
      'fecha_vto'   => 'Date',
      'devprod_id'  => 'Number',
      'observacion' => 'Text',
      'usuario'     => 'ForeignKey',
      'nro_recibo'  => 'Number',
      'zona_id'     => 'ForeignKey',
      'archivo'     => 'Text',
    );
  }
}
