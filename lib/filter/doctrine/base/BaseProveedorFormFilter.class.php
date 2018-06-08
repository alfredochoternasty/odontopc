<?php

/**
 * Proveedor filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProveedorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cuit'               => new sfWidgetFormFilterInput(),
      'condicionfiscal_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'add_empty' => true)),
      'razon_social'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicilio'          => new sfWidgetFormFilterInput(),
      'localidad_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'telefono'           => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'observacion'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cuit'               => new sfValidatorPass(array('required' => false)),
      'condicionfiscal_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Condfiscal'), 'column' => 'id')),
      'razon_social'       => new sfValidatorPass(array('required' => false)),
      'domicilio'          => new sfValidatorPass(array('required' => false)),
      'localidad_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
      'telefono'           => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'observacion'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proveedor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proveedor';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'cuit'               => 'Text',
      'condicionfiscal_id' => 'ForeignKey',
      'razon_social'       => 'Text',
      'domicilio'          => 'Text',
      'localidad_id'       => 'ForeignKey',
      'telefono'           => 'Text',
      'email'              => 'Text',
      'observacion'        => 'Text',
    );
  }
}
