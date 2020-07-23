<?php

/**
 * PromocionProducto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePromocionProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'promocion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Promocion'), 'add_empty' => true)),
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'promocion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Promocion'), 'column' => 'id')),
      'producto_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('promocion_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PromocionProducto';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'promocion_id' => 'ForeignKey',
      'producto_id'  => 'ForeignKey',
    );
  }
}
