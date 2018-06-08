<?php

/**
 * Compra form base class.
 *
 * @method Compra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'cuenta_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuenta'), 'add_empty' => false)),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'), 'add_empty' => false)),
      'numero'         => new sfWidgetFormInputText(),
      'fecha'          => new sfWidgetFormDate(),
      'proveedor_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => false)),
      'moneda_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'observacion'    => new sfWidgetFormInputText(),
      'pagado'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cuenta_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuenta'))),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'))),
      'numero'         => new sfValidatorInteger(),
      'fecha'          => new sfValidatorDate(),
      'proveedor_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'))),
      'moneda_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'observacion'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'pagado'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compra';
  }

}
