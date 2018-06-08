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
      'id'            => new sfWidgetFormInputHidden(),
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'nro_lote'      => new sfWidgetFormInputText(),
      'nro_venta'     => new sfWidgetFormInputText(),
      'fecha_venta'   => new sfWidgetFormDate(),
      'cliente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'fecha_compra'  => new sfWidgetFormDate(),
      'proveedor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'numero'        => new sfWidgetFormInputText(),
      'cant_vendida'  => new sfWidgetFormInputText(),
      'cant_comprada' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'producto_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'nro_lote'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nro_venta'     => new sfValidatorInteger(array('required' => false)),
      'fecha_venta'   => new sfValidatorDate(array('required' => false)),
      'cliente_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'fecha_compra'  => new sfValidatorDate(array('required' => false)),
      'proveedor_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'numero'        => new sfValidatorInteger(array('required' => false)),
      'cant_vendida'  => new sfValidatorInteger(array('required' => false)),
      'cant_comprada' => new sfValidatorInteger(array('required' => false)),
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
