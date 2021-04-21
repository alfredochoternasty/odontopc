<?php

/**
 * Resumen form base class.
 *
 * @method Resumen getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResumenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'fecha'            => new sfWidgetFormDate(),
      'tipo_venta_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoVenta'), 'add_empty' => false)),
      'cliente_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'remito_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Remito'), 'add_empty' => true)),
      'lista_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'moneda_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'observacion'      => new sfWidgetFormInputText(),
      'pagado'           => new sfWidgetFormInputText(),
      'fecha_pagado'     => new sfWidgetFormDate(),
      'pedido_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pedido'), 'add_empty' => true)),
      'nro_factura'      => new sfWidgetFormInputText(),
      'tipofactura_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => false)),
      'usuario'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'afip_estado'      => new sfWidgetFormInputText(),
      'afip_cae'         => new sfWidgetFormInputText(),
      'afip_vto_cae'     => new sfWidgetFormDate(),
      'pto_vta'          => new sfWidgetFormInputText(),
      'afip_envio'       => new sfWidgetFormTextarea(),
      'afip_respuesta'   => new sfWidgetFormTextarea(),
      'afip_mensaje'     => new sfWidgetFormInputText(),
      'pago_comision_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PagoComision'), 'add_empty' => true)),
      'zona_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'presupuesto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'), 'add_empty' => true)),
      'comp_asoc_id'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'            => new sfValidatorDate(),
      'tipo_venta_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoVenta'))),
      'cliente_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'remito_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Remito'), 'required' => false)),
      'lista_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'required' => false)),
      'moneda_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'observacion'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'pagado'           => new sfValidatorInteger(array('required' => false)),
      'fecha_pagado'     => new sfValidatorDate(array('required' => false)),
      'pedido_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pedido'), 'required' => false)),
      'nro_factura'      => new sfValidatorInteger(array('required' => false)),
      'tipofactura_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'))),
      'usuario'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'afip_estado'      => new sfValidatorInteger(array('required' => false)),
      'afip_cae'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'afip_vto_cae'     => new sfValidatorDate(array('required' => false)),
      'pto_vta'          => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'afip_envio'       => new sfValidatorString(array('required' => false)),
      'afip_respuesta'   => new sfValidatorString(array('required' => false)),
      'afip_mensaje'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pago_comision_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PagoComision'), 'required' => false)),
      'zona_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'presupuesto_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'), 'required' => false)),
      'comp_asoc_id'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resumen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resumen';
  }

}
