<?php

/**
 * ClienteUltimaCompra form base class.
 *
 * @method ClienteUltimaCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteUltimaCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'cliente_id' => new sfWidgetFormInputText(),
      'apellido'   => new sfWidgetFormInputText(),
      'nombre'     => new sfWidgetFormInputText(),
      'fecha'      => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cliente_id' => new sfValidatorInteger(array('required' => false)),
      'apellido'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'fecha'      => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_ultima_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteUltimaCompra';
  }

}
