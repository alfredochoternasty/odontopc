<?php

/**
 * DetalleFacturaCompra form base class.
 *
 * @method DetalleFacturaCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetalleFacturaCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'factcompra_id' => new sfWidgetFormInputHidden(),
      'producto_id'   => new sfWidgetFormInputHidden(),
      'precio'        => new sfWidgetFormInputText(),
      'cantidad'      => new sfWidgetFormInputText(),
      'total'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'factcompra_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('factcompra_id')), 'empty_value' => $this->getObject()->get('factcompra_id'), 'required' => false)),
      'producto_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('producto_id')), 'empty_value' => $this->getObject()->get('producto_id'), 'required' => false)),
      'precio'        => new sfValidatorNumber(),
      'cantidad'      => new sfValidatorInteger(array('required' => false)),
      'total'         => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_factura_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleFacturaCompra';
  }

}
