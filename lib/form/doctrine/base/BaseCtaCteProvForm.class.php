<?php

/**
 * CtaCteProv form base class.
 *
 * @method CtaCteProv getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCtaCteProvForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'concepto'     => new sfWidgetFormInputText(),
      'numero'       => new sfWidgetFormInputText(),
      'fecha'        => new sfWidgetFormDate(),
      'proveedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => false)),
      'cuenta_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuenta'), 'add_empty' => false)),
      'moneda_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'debe'         => new sfWidgetFormInputText(),
      'haber'        => new sfWidgetFormInputText(),
      'observacion'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'concepto'     => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'numero'       => new sfValidatorInteger(array('required' => false)),
      'fecha'        => new sfValidatorDate(),
      'proveedor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'))),
      'cuenta_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuenta'))),
      'moneda_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'debe'         => new sfValidatorNumber(),
      'haber'        => new sfValidatorNumber(),
      'observacion'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cta_cte_prov[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CtaCteProv';
  }

}
