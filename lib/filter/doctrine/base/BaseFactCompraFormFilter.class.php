<?php

/**
 * FactCompra filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFactCompraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proveedor_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'numero'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'), 'add_empty' => true)),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'moneda_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'observacion'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'proveedor_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'numero'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipofactura'), 'column' => 'id')),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'moneda_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'observacion'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fact_compra_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FactCompra';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'proveedor_id'   => 'ForeignKey',
      'numero'         => 'Number',
      'tipofactura_id' => 'ForeignKey',
      'fecha'          => 'Date',
      'moneda_id'      => 'ForeignKey',
      'observacion'    => 'Text',
    );
  }
}
