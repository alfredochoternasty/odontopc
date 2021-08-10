<?php

/**
 * Pago form base class.
 *
 * @method Pago getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePagoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'fecha'        => new sfWidgetFormDate(),
      'proveedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => false)),
      'moneda_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'monto'        => new sfWidgetFormInputText(),
      'tipo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'banco_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true)),
      'numero'       => new sfWidgetFormInputText(),
      'observacion'  => new sfWidgetFormInputText(),
      'comprobante'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'        => new sfValidatorDate(),
      'proveedor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'))),
      'moneda_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'monto'        => new sfValidatorNumber(),
      'tipo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'banco_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'required' => false)),
      'numero'       => new sfValidatorInteger(array('required' => false)),
      'observacion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comprobante'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pago[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pago';
  }

}
