<?php

/**
 * DetFactCompra form base class.
 *
 * @method DetFactCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetFactCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'factcompra_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Factura'), 'add_empty' => true)),
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupoprod'), 'add_empty' => true)),
      'precio'        => new sfWidgetFormInputText(),
      'cantidad'      => new sfWidgetFormInputText(),
      'subtotal'      => new sfWidgetFormInputText(),
      'iva'           => new sfWidgetFormInputText(),
      'total'         => new sfWidgetFormInputText(),
      'nro_lote'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'factcompra_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Factura'), 'required' => false)),
      'producto_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'grupoprod_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupoprod'), 'required' => false)),
      'precio'        => new sfValidatorNumber(),
      'cantidad'      => new sfValidatorInteger(array('required' => false)),
      'subtotal'      => new sfValidatorNumber(),
      'iva'           => new sfValidatorNumber(),
      'total'         => new sfValidatorNumber(array('required' => false)),
      'nro_lote'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('det_fact_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetFactCompra';
  }

}
