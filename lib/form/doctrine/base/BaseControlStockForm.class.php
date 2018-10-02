<?php

/**
 * ControlStock form base class.
 *
 * @method ControlStock getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseControlStockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'proveedor_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'producto_nombre' => new sfWidgetFormInputText(),
      'nro_lote'        => new sfWidgetFormInputText(),
      'comprados'       => new sfWidgetFormInputText(),
      'vendidos'        => new sfWidgetFormInputText(),
      'stock_calculado' => new sfWidgetFormInputText(),
      'stock_guardado'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'proveedor_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'producto_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'producto_nombre' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nro_lote'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comprados'       => new sfValidatorInteger(array('required' => false)),
      'vendidos'        => new sfValidatorInteger(array('required' => false)),
      'stock_calculado' => new sfValidatorInteger(array('required' => false)),
      'stock_guardado'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('control_stock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ControlStock';
  }

}
