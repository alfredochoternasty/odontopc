<?php

/**
 * DetalleVenta form base class.
 *
 * @method DetalleVenta getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetalleVentaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'venta_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Venta'), 'add_empty' => false)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => false)),
      'precio'      => new sfWidgetFormInputText(),
      'cantidad'    => new sfWidgetFormInputText(),
      'subtotal'    => new sfWidgetFormInputText(),
      'iva'         => new sfWidgetFormInputText(),
      'total'       => new sfWidgetFormInputText(),
      'observacion' => new sfWidgetFormInputText(),
      'nro_lote'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'venta_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Venta'))),
      'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'))),
      'precio'      => new sfValidatorNumber(),
      'cantidad'    => new sfValidatorInteger(array('required' => false)),
      'subtotal'    => new sfValidatorNumber(),
      'iva'         => new sfValidatorNumber(),
      'total'       => new sfValidatorNumber(array('required' => false)),
      'observacion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nro_lote'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_venta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleVenta';
  }

}
