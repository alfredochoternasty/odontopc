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
      'dni'          => new sfWidgetFormFilterInput(),
      'apellido'     => new sfWidgetFormFilterInput(),
      'nombre'       => new sfWidgetFormFilterInput(),
      'tipo_cliente' => new sfWidgetFormFilterInput(),
      'simbolo'      => new sfWidgetFormFilterInput(),
      'moneda'       => new sfWidgetFormFilterInput(),
      'saldo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'concepto'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dni'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'apellido'     => new sfValidatorPass(array('required' => false)),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'tipo_cliente' => new sfValidatorPass(array('required' => false)),
      'simbolo'      => new sfValidatorPass(array('required' => false)),
      'moneda'       => new sfValidatorPass(array('required' => false)),
      'saldo'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fecha'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'concepto'     => new sfValidatorPass(array('required' => false)),
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
      'id'           => 'Number',
      'dni'          => 'Number',
      'apellido'     => 'Text',
      'nombre'       => 'Text',
      'tipo_cliente' => 'Text',
      'simbolo'      => 'Text',
      'moneda'       => 'Text',
      'saldo'        => 'Number',
      'fecha'        => 'Date',
      'concepto'     => 'Text',
    );
  }
}
