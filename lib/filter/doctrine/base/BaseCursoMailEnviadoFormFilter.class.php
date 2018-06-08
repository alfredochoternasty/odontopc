<?php

/**
 * CursoMailEnviado filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursoMailEnviadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'curso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'fecha'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'e_mail'       => new sfWidgetFormFilterInput(),
      'lo_vio'       => new sfWidgetFormFilterInput(),
      'se_inscribio' => new sfWidgetFormFilterInput(),
      'observacion'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'curso_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id')),
      'fecha'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'e_mail'       => new sfValidatorPass(array('required' => false)),
      'lo_vio'       => new sfValidatorPass(array('required' => false)),
      'se_inscribio' => new sfValidatorPass(array('required' => false)),
      'observacion'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso_mail_enviado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursoMailEnviado';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'curso_id'     => 'ForeignKey',
      'fecha'        => 'Date',
      'e_mail'       => 'Text',
      'lo_vio'       => 'Text',
      'se_inscribio' => 'Text',
      'observacion'  => 'Text',
    );
  }
}
