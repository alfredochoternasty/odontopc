<?php

/**
 * ProductoTraza form base class.
 *
 * @method ProductoTraza getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoTrazaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'resumen_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'fecha_venta' => new sfWidgetFormDate(),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'nro_lote'    => new sfWidgetFormInputText(),
      'fecha_vto'   => new sfWidgetFormDate(),
      'vendidos'    => new sfWidgetFormInputText(),
      'devueltos'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'resumen_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'required' => false)),
      'fecha_venta' => new sfValidatorDate(array('required' => false)),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'nro_lote'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'fecha_vto'   => new sfValidatorDate(array('required' => false)),
      'vendidos'    => new sfValidatorInteger(array('required' => false)),
      'devueltos'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto_traza[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoTraza';
  }

}
