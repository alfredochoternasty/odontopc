<?php

/**
 * CobroResumen form base class.
 *
 * @method CobroResumen getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCobroResumenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cobro_id'   => new sfWidgetFormInputHidden(),
      'resumen_id' => new sfWidgetFormInputHidden(),
      'monto'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cobro_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cobro_id')), 'empty_value' => $this->getObject()->get('cobro_id'), 'required' => false)),
      'resumen_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('resumen_id')), 'empty_value' => $this->getObject()->get('resumen_id'), 'required' => false)),
      'monto'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cobro_resumen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CobroResumen';
  }

}
