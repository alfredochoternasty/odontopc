<?php

/**
 * ClienteSaldo form base class.
 *
 * @method ClienteSaldo getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteSaldoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'dni'          => new sfWidgetFormInputText(),
      'apellido'     => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'tipo_cliente' => new sfWidgetFormInputText(),
      'simbolo'      => new sfWidgetFormInputText(),
      'moneda'       => new sfWidgetFormInputText(),
      'saldo'        => new sfWidgetFormInputText(),
      'fecha'        => new sfWidgetFormDate(),
      'concepto'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dni'          => new sfValidatorInteger(array('required' => false)),
      'apellido'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tipo_cliente' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'simbolo'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'moneda'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'saldo'        => new sfValidatorNumber(),
      'fecha'        => new sfValidatorDate(),
      'concepto'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_saldo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteSaldo';
  }

}
