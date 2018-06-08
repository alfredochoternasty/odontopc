<?php


abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
public function setup()
{
}
}

/**
 * FacturaCompra filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFacturaCompraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'compra_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'numero'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipofactura_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'observacion'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'compra_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Compra'), 'column' => 'id')),
      'numero'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipofactura_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'observacion'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('factura_compra_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacturaCompra';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'compra_id'      => 'ForeignKey',
      'numero'         => 'Number',
      'tipofactura_id' => 'Number',
      'fecha'          => 'Date',
      'observacion'    => 'Text',
    );
  }
}
