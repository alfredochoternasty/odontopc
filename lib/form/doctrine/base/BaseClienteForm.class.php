<?php

/**
 * Cliente form base class.
 *
 * @method Cliente getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'tipo_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'dni'                => new sfWidgetFormInputText(),
      'cuit'               => new sfWidgetFormInputText(),
      'condicionfiscal_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'add_empty' => true)),
      'genera_comision'    => new sfWidgetFormInputCheckbox(),
      'sexo'               => new sfWidgetFormInputText(),
      'apellido'           => new sfWidgetFormInputText(),
      'nombre'             => new sfWidgetFormInputText(),
      'fecha_nacimiento'   => new sfWidgetFormDate(),
      'domicilio'          => new sfWidgetFormInputText(),
      'localidad_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'telefono'           => new sfWidgetFormInputText(),
      'celular'            => new sfWidgetFormInputText(),
      'fax'                => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'observacion'        => new sfWidgetFormInputText(),
      'usuario_id'         => new sfWidgetFormInputText(),
      'lista_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false)),
      'activo'             => new sfWidgetFormInputCheckbox(),
      'recibir_curso'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipo_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'required' => false)),
      'dni'                => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'cuit'               => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'condicionfiscal_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'required' => false)),
      'genera_comision'    => new sfValidatorBoolean(array('required' => false)),
      'sexo'               => new sfValidatorString(array('max_length' => 1)),
      'apellido'           => new sfValidatorString(array('max_length' => 50)),
      'nombre'             => new sfValidatorString(array('max_length' => 50)),
      'fecha_nacimiento'   => new sfValidatorDate(array('required' => false)),
      'domicilio'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'localidad_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'required' => false)),
      'telefono'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'celular'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'fax'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'observacion'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'usuario_id'         => new sfValidatorInteger(array('required' => false)),
      'lista_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'))),
      'activo'             => new sfValidatorBoolean(array('required' => false)),
      'recibir_curso'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }

}
