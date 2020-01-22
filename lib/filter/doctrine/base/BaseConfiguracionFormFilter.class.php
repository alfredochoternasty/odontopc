<?php

/**
 * Configuracion filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConfiguracionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valor'       => new sfWidgetFormFilterInput(),
      'observacion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'valor'       => new sfValidatorPass(array('required' => false)),
      'observacion' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('configuracion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Configuracion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Text',
      'valor'       => 'Text',
      'observacion' => 'Text',
    );
  }
}
