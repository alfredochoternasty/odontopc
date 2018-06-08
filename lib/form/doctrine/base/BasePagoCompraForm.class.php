<?php

/**
 * PagoCompra form base class.
 *
 * @method PagoCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePagoCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pago_id'   => new sfWidgetFormInputHidden(),
      'compra_id' => new sfWidgetFormInputHidden(),
      'monto'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'pago_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('pago_id')), 'empty_value' => $this->getObject()->get('pago_id'), 'required' => false)),
      'compra_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('compra_id')), 'empty_value' => $this->getObject()->get('compra_id'), 'required' => false)),
      'monto'     => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pago_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PagoCompra';
  }

}
