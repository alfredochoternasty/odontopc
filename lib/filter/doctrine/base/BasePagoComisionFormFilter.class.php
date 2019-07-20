<?php

/**
 * PagoComision filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePagoComisionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'revendedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Revendedor'), 'add_empty' => true)),
      'moneda_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'monto'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'banco_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true)),
      'referencia'    => new sfWidgetFormFilterInput(),
      'fecha_vto'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'observacion'   => new sfWidgetFormFilterInput(),
      'nro_recibo'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'revendedor_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Revendedor'), 'column' => 'id')),
      'moneda_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'monto'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tipo_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'banco_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Banco'), 'column' => 'id')),
      'referencia'    => new sfValidatorPass(array('required' => false)),
      'fecha_vto'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'observacion'   => new sfValidatorPass(array('required' => false)),
      'nro_recibo'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('pago_comision_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PagoComision';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'fecha'         => 'Date',
      'revendedor_id' => 'ForeignKey',
      'moneda_id'     => 'ForeignKey',
      'monto'         => 'Number',
      'tipo_id'       => 'ForeignKey',
      'banco_id'      => 'ForeignKey',
      'referencia'    => 'Text',
      'fecha_vto'     => 'Date',
      'observacion'   => 'Text',
      'nro_recibo'    => 'Number',
    );
  }
}
