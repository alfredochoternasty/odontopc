<?php

/**
 * Grupoprod form base class.
 *
 * @method Grupoprod getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGrupoprodForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'color'        => new sfWidgetFormInputText(),
      'foto'         => new sfWidgetFormInputText(),
      'foto_chica'   => new sfWidgetFormInputText(),
      'categoria_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 50)),
      'color'        => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'foto'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'foto_chica'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'categoria_id' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grupoprod[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupoprod';
  }

}
