<?php

/**
 * ListaPrecio form base class.
 *
 * @method ListaPrecio getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListaPrecioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'nombre'    => new sfWidgetFormInputText(),
      'moneda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'aumento'   => new sfWidgetFormInputText(),
      'descuento' => new sfWidgetFormInputText(),
      'precio'    => new sfWidgetFormInputText(),
      'defecto'   => new sfWidgetFormInputCheckbox(),
      'activo'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'    => new sfValidatorString(array('max_length' => 100)),
      'moneda_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'aumento'   => new sfValidatorInteger(array('required' => false)),
      'descuento' => new sfValidatorInteger(array('required' => false)),
      'precio'    => new sfValidatorNumber(array('required' => false)),
      'defecto'   => new sfValidatorBoolean(array('required' => false)),
      'activo'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lista_precio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListaPrecio';
  }

}
