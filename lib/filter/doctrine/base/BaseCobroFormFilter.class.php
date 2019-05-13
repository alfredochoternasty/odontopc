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
      'concepto'    => new sfWidgetFormFilterInput(),
      'numero'      => new sfWidgetFormFilterInput(),
      'fecha'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'moneda_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'debe'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'haber'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observacion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'concepto'    => new sfValidatorPass(array('required' => false)),
      'numero'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'moneda_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'debe'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'haber'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion' => new sfValidatorPass(array('required' => false)),
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
      'concepto'    => 'Text',
      'numero'      => 'Number',
      'fecha'       => 'Date',
      'cliente_id'  => 'ForeignKey',
      'moneda_id'   => 'ForeignKey',
      'debe'        => 'Number',
      'haber'       => 'Number',
      'observacion' => 'Text',
    );
  }
}
