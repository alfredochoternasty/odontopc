<?php

/**
 * DescuentoZona filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDescuentoZonaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupoprod'), 'add_empty' => true)),
      'porc_desc'    => new sfWidgetFormFilterInput(),
      'precio_desc'  => new sfWidgetFormFilterInput(),
      'zona_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'cliente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'producto_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupoprod'), 'column' => 'id')),
      'porc_desc'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio_desc'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'zona_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'cliente_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('descuento_zona_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DescuentoZona';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'producto_id'  => 'ForeignKey',
      'grupoprod_id' => 'ForeignKey',
      'porc_desc'    => 'Number',
      'precio_desc'  => 'Number',
      'zona_id'      => 'ForeignKey',
      'cliente_id'   => 'ForeignKey',
    );
  }
}
