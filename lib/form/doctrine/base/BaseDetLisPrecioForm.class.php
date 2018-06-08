<?php

/**
 * DetLisPrecio form base class.
 *
 * @method DetLisPrecio getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetLisPrecioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'lista_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false)),
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'aumento'      => new sfWidgetFormInputText(),
      'descuento'    => new sfWidgetFormInputText(),
      'precio'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lista_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'))),
      'producto_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'aumento'      => new sfValidatorInteger(array('required' => false)),
      'descuento'    => new sfValidatorInteger(array('required' => false)),
      'precio'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('det_lis_precio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetLisPrecio';
  }

}
