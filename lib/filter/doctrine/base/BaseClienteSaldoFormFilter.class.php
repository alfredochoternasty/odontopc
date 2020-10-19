<?php

/**
 * ClienteSaldo filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClienteSaldoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'apellido'  => new sfWidgetFormFilterInput(),
      'nombre'    => new sfWidgetFormFilterInput(),
      'moneda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'saldo'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'zona_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'ult_cobro' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ult_venta' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'apellido'  => new sfValidatorPass(array('required' => false)),
      'nombre'    => new sfValidatorPass(array('required' => false)),
      'moneda_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'saldo'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'zona_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'ult_cobro' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'ult_venta' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('cliente_saldo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteSaldo';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'apellido'  => 'Text',
      'nombre'    => 'Text',
      'moneda_id' => 'ForeignKey',
      'saldo'     => 'Number',
      'zona_id'   => 'ForeignKey',
      'ult_cobro' => 'Date',
      'ult_venta' => 'Date',
    );
  }
}
