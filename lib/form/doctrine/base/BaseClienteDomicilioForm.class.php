<?php

/**
 * ClienteDomicilio form base class.
 *
 * @method ClienteDomicilio getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteDomicilioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'cliente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'direccion'    => new sfWidgetFormInputText(),
      'telefono'     => new sfWidgetFormInputText(),
      'correo'       => new sfWidgetFormInputText(),
      'observacion'  => new sfWidgetFormInputText(),
      'localidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cliente_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'direccion'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telefono'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'correo'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'observacion'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'localidad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_domicilio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteDomicilio';
  }

}
