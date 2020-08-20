<?php

/**
 * Localidad filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLocalidadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'provincia_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Provincia'), 'add_empty' => true)),
      'codigo_postal' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'        => new sfValidatorPass(array('required' => false)),
      'provincia_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Provincia'), 'column' => 'id')),
      'codigo_postal' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('localidad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Localidad';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nombre'        => 'Text',
      'provincia_id'  => 'ForeignKey',
      'codigo_postal' => 'Text',
    );
  }
}
