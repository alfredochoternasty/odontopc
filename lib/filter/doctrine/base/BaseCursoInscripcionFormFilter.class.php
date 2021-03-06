<?php

/**
 * CursoInscripcion filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursoInscripcionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'curso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'cliente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'nombre'       => new sfWidgetFormFilterInput(),
      'correo'       => new sfWidgetFormFilterInput(),
      'es_cliente'   => new sfWidgetFormFilterInput(),
      'fecha'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tipo_insc_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoInscripcion'), 'add_empty' => true)),
      'comentario'   => new sfWidgetFormFilterInput(),
      'asistio'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pago'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'visto'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'compro'       => new sfWidgetFormFilterInput(),
      'observacion'  => new sfWidgetFormFilterInput(),
      'telefono'     => new sfWidgetFormFilterInput(),
      'dni'          => new sfWidgetFormFilterInput(),
      'localidad'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'curso_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id')),
      'cliente_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'correo'       => new sfValidatorPass(array('required' => false)),
      'es_cliente'   => new sfValidatorPass(array('required' => false)),
      'fecha'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tipo_insc_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoInscripcion'), 'column' => 'id')),
      'comentario'   => new sfValidatorPass(array('required' => false)),
      'asistio'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pago'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'visto'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'compro'       => new sfValidatorPass(array('required' => false)),
      'observacion'  => new sfValidatorPass(array('required' => false)),
      'telefono'     => new sfValidatorPass(array('required' => false)),
      'dni'          => new sfValidatorPass(array('required' => false)),
      'localidad'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso_inscripcion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursoInscripcion';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'curso_id'     => 'ForeignKey',
      'cliente_id'   => 'ForeignKey',
      'nombre'       => 'Text',
      'correo'       => 'Text',
      'es_cliente'   => 'Text',
      'fecha'        => 'Date',
      'tipo_insc_id' => 'ForeignKey',
      'comentario'   => 'Text',
      'asistio'      => 'Boolean',
      'pago'         => 'Boolean',
      'visto'        => 'Boolean',
      'compro'       => 'Text',
      'observacion'  => 'Text',
      'telefono'     => 'Text',
      'dni'          => 'Text',
      'localidad'    => 'Text',
    );
  }
}
