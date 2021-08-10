<?php

/**
 * Envio form base class.
 *
 * @method Envio getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEnvioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'resumen_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => false)),
      'estado_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'), 'add_empty' => false)),
      'fecha'           => new sfWidgetFormDate(),
      'empresa_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => false)),
      'fecha_salida'    => new sfWidgetFormInputText(),
      'fecha_llegada'   => new sfWidgetFormInputText(),
      'nro_seguimiento' => new sfWidgetFormInputText(),
      'comprobante'     => new sfWidgetFormInputText(),
      'observacion'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'resumen_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'))),
      'estado_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'))),
      'fecha'           => new sfValidatorDate(),
      'empresa_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'))),
      'fecha_salida'    => new sfValidatorNumber(),
      'fecha_llegada'   => new sfValidatorInteger(array('required' => false)),
      'nro_seguimiento' => new sfValidatorInteger(array('required' => false)),
      'comprobante'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'observacion'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('envio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Envio';
  }

}
