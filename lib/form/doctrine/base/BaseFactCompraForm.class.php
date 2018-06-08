<?php

/**
 * FactCompra form base class.
 *
 * @method FactCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFactCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'proveedor_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => false)),
      'numero'         => new sfWidgetFormInputText(),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'), 'add_empty' => false)),
      'fecha'          => new sfWidgetFormDate(),
      'moneda_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'observacion'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'proveedor_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'))),
      'numero'         => new sfValidatorInteger(),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'))),
      'fecha'          => new sfValidatorDate(),
      'moneda_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'observacion'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fact_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FactCompra';
  }

}
