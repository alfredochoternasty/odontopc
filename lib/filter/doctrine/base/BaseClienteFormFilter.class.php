<?php

/**
 * Cliente filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClienteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'dni'                => new sfWidgetFormFilterInput(),
      'cuit'               => new sfWidgetFormFilterInput(),
      'condicionfiscal_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'add_empty' => true)),
      'genera_comision'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sexo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_nacimiento'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'domicilio'          => new sfWidgetFormFilterInput(),
      'localidad_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'telefono'           => new sfWidgetFormFilterInput(),
      'celular'            => new sfWidgetFormFilterInput(),
      'fax'                => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'observacion'        => new sfWidgetFormFilterInput(),
      'usuario_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'lista_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'activo'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'recibir_curso'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'zona_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tipo_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'dni'                => new sfValidatorPass(array('required' => false)),
      'cuit'               => new sfValidatorPass(array('required' => false)),
      'condicionfiscal_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Condfiscal'), 'column' => 'id')),
      'genera_comision'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sexo'               => new sfValidatorPass(array('required' => false)),
      'apellido'           => new sfValidatorPass(array('required' => false)),
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'fecha_nacimiento'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'domicilio'          => new sfValidatorPass(array('required' => false)),
      'localidad_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
      'telefono'           => new sfValidatorPass(array('required' => false)),
      'celular'            => new sfValidatorPass(array('required' => false)),
      'fax'                => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'observacion'        => new sfValidatorPass(array('required' => false)),
      'usuario_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'lista_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'activo'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'recibir_curso'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'zona_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cliente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'tipo_id'            => 'ForeignKey',
      'dni'                => 'Text',
      'cuit'               => 'Text',
      'condicionfiscal_id' => 'ForeignKey',
      'genera_comision'    => 'Boolean',
      'sexo'               => 'Text',
      'apellido'           => 'Text',
      'nombre'             => 'Text',
      'fecha_nacimiento'   => 'Date',
      'domicilio'          => 'Text',
      'localidad_id'       => 'ForeignKey',
      'telefono'           => 'Text',
      'celular'            => 'Text',
      'fax'                => 'Text',
      'email'              => 'Text',
      'observacion'        => 'Text',
      'usuario_id'         => 'ForeignKey',
      'lista_id'           => 'ForeignKey',
      'activo'             => 'Boolean',
      'recibir_curso'      => 'Boolean',
      'zona_id'            => 'ForeignKey',
    );
  }
}
