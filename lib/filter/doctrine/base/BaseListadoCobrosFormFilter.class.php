<?php

/**
 * ListadoCobros filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListadoCobrosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'tipo_cliente'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCliente'), 'add_empty' => true)),
      'tipo_cobro'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCobro'), 'add_empty' => true)),
      'moneda'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'cli_gen_comis' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'monto'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'tipo_cliente'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoCliente'), 'column' => 'id')),
      'tipo_cobro'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoCobro'), 'column' => 'id')),
      'moneda'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'cli_gen_comis' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'monto'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('listado_cobros_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoCobros';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'fecha'         => 'Date',
      'cliente'       => 'ForeignKey',
      'tipo_cliente'  => 'ForeignKey',
      'tipo_cobro'    => 'ForeignKey',
      'moneda'        => 'ForeignKey',
      'cli_gen_comis' => 'Boolean',
      'monto'         => 'Number',
    );
  }
}
