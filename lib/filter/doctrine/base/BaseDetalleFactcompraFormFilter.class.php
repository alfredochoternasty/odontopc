<?php


abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
public function setup()
{
}
}

/**
 * DetalleFactcompra filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetalleFactcompraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'precio'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'precio'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('detalle_factcompra_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleFactcompra';
  }

  public function getFields()
  {
    return array(
      'factcompra_id' => 'Number',
      'producto_id'   => 'Number',
      'precio'        => 'Number',
      'cantidad'      => 'Number',
      'total'         => 'Number',
    );
  }
}
