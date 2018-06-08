<?php

/**
 * CursoMailEnviado form base class.
 *
 * @method CursoMailEnviado getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoMailEnviadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'curso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => false)),
      'fecha'        => new sfWidgetFormDate(),
      'e_mail'       => new sfWidgetFormInputText(),
      'lo_vio'       => new sfWidgetFormInputText(),
      'se_inscribio' => new sfWidgetFormInputText(),
      'observacion'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'curso_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'))),
      'fecha'        => new sfValidatorDate(),
      'e_mail'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'lo_vio'       => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'se_inscribio' => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'observacion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso_mail_enviado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursoMailEnviado';
  }

}
