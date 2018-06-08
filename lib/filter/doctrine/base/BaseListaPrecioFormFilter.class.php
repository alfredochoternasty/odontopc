<?php

/**
 * ListaPrecio filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListaPrecioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'moneda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'aumento'   => new sfWidgetFormFilterInput(),
      'descuento' => new sfWidgetFormFilterInput(),
      'precio'    => new sfWidgetFormFilterInput(),
      'defecto'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'activo'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'nombre'    => new sfValidatorPass(array('required' => false)),
      'moneda_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'aumento'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descuento' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'defecto'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'activo'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('lista_precio_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListaPrecio';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'nombre'    => 'Text',
      'moneda_id' => 'ForeignKey',
      'aumento'   => 'Number',
      'descuento' => 'Number',
      'precio'    => 'Number',
      'defecto'   => 'Boolean',
      'activo'    => 'Boolean',
    );
  }
}
