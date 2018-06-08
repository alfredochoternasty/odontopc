<?php

/**
 * DetLisPrecio filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetLisPrecioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'lista_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'aumento'      => new sfWidgetFormFilterInput(),
      'descuento'    => new sfWidgetFormFilterInput(),
      'precio'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'lista_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'producto_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'aumento'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descuento'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('det_lis_precio_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetLisPrecio';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'lista_id'     => 'ForeignKey',
      'producto_id'  => 'ForeignKey',
      'grupoprod_id' => 'ForeignKey',
      'aumento'      => 'Number',
      'descuento'    => 'Number',
      'precio'       => 'Number',
    );
  }
}
