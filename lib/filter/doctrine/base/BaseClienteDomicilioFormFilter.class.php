<?php

/**
 * ClienteDomicilio filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClienteDomicilioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cliente_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'direccion'    => new sfWidgetFormFilterInput(),
      'telefono'     => new sfWidgetFormFilterInput(),
      'correo'       => new sfWidgetFormFilterInput(),
      'observacion'  => new sfWidgetFormFilterInput(),
      'localidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cliente_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'direccion'    => new sfValidatorPass(array('required' => false)),
      'telefono'     => new sfValidatorPass(array('required' => false)),
      'correo'       => new sfValidatorPass(array('required' => false)),
      'observacion'  => new sfValidatorPass(array('required' => false)),
      'localidad_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cliente_domicilio_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteDomicilio';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'cliente_id'   => 'ForeignKey',
      'direccion'    => 'Text',
      'telefono'     => 'Text',
      'correo'       => 'Text',
      'observacion'  => 'Text',
      'localidad_id' => 'ForeignKey',
    );
  }
}
