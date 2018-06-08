<?php

/**
 * CursoInscripcion form base class.
 *
 * @method CursoInscripcion getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoInscripcionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'curso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => false)),
      'cliente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'nombre'       => new sfWidgetFormInputText(),
      'correo'       => new sfWidgetFormInputText(),
      'es_cliente'   => new sfWidgetFormInputText(),
      'fecha'        => new sfWidgetFormDate(),
      'tipo_insc_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoInscripcion'), 'add_empty' => false)),
      'comentario'   => new sfWidgetFormInputText(),
      'asistio'      => new sfWidgetFormInputText(),
      'pago_monto'   => new sfWidgetFormInputText(),
      'mas_info'     => new sfWidgetFormInputText(),
      'compro'       => new sfWidgetFormInputText(),
      'observacion'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'curso_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'))),
      'cliente_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'nombre'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'correo'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'es_cliente'   => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'fecha'        => new sfValidatorDate(),
      'tipo_insc_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoInscripcion'))),
      'comentario'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'asistio'      => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'pago_monto'   => new sfValidatorNumber(array('required' => false)),
      'mas_info'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'compro'       => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'observacion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso_inscripcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursoInscripcion';
  }

}
