<?php

/**
 * Proveedor form base class.
 *
 * @method Proveedor getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProveedorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'cuit'               => new sfWidgetFormInputText(),
      'condicionfiscal_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'add_empty' => false)),
      'razon_social'       => new sfWidgetFormInputText(),
      'domicilio'          => new sfWidgetFormInputText(),
      'localidad_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'telefono'           => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'observacion'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cuit'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'condicionfiscal_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'))),
      'razon_social'       => new sfValidatorString(array('max_length' => 100)),
      'domicilio'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'localidad_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'required' => false)),
      'telefono'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'observacion'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proveedor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proveedor';
  }

}
