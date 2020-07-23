<?php

/**
 * Promocion form base class.
 *
 * @method Promocion getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePromocionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'estado'      => new sfWidgetFormInputText(),
      'fecha_ini'   => new sfWidgetFormDate(),
      'fecha_fin'   => new sfWidgetFormDate(),
      'tipo_id'     => new sfWidgetFormInputText(),
      'min_cant'    => new sfWidgetFormInputText(),
      'cant_regalo' => new sfWidgetFormInputText(),
      'porc_desc'   => new sfWidgetFormInputText(),
      'aplica_neto' => new sfWidgetFormInputText(),
      'lista_id'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'estado'      => new sfValidatorInteger(array('required' => false)),
      'fecha_ini'   => new sfValidatorDate(array('required' => false)),
      'fecha_fin'   => new sfValidatorDate(array('required' => false)),
      'tipo_id'     => new sfValidatorInteger(array('required' => false)),
      'min_cant'    => new sfValidatorInteger(array('required' => false)),
      'cant_regalo' => new sfValidatorInteger(array('required' => false)),
      'porc_desc'   => new sfValidatorInteger(array('required' => false)),
      'aplica_neto' => new sfValidatorInteger(array('required' => false)),
      'lista_id'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('promocion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Promocion';
  }

}
