<?php

/**
 * Resumen filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResumenFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tipo_venta_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoVenta'), 'add_empty' => true)),
      'cliente_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'remito_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Remito'), 'add_empty' => true)),
      'lista_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'moneda_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'observacion'      => new sfWidgetFormFilterInput(),
      'pagado'           => new sfWidgetFormFilterInput(),
      'fecha_pagado'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pedido_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pedido'), 'add_empty' => true)),
      'nro_factura'      => new sfWidgetFormFilterInput(),
      'tipofactura_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'usuario'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'afip_estado'      => new sfWidgetFormFilterInput(),
      'afip_cae'         => new sfWidgetFormFilterInput(),
      'afip_vto_cae'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pto_vta'          => new sfWidgetFormFilterInput(),
      'afip_envio'       => new sfWidgetFormFilterInput(),
      'afip_respuesta'   => new sfWidgetFormFilterInput(),
      'afip_mensaje'     => new sfWidgetFormFilterInput(),
      'pago_comision_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PagoComision'), 'add_empty' => true)),
      'zona_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'presupuesto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tipo_venta_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoVenta'), 'column' => 'id')),
      'cliente_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'remito_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Remito'), 'column' => 'id')),
      'lista_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'moneda_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'observacion'      => new sfValidatorPass(array('required' => false)),
      'pagado'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_pagado'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pedido_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pedido'), 'column' => 'id')),
      'nro_factura'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipofactura_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoFactura'), 'column' => 'id')),
      'usuario'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'afip_estado'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'afip_cae'         => new sfValidatorPass(array('required' => false)),
      'afip_vto_cae'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pto_vta'          => new sfValidatorPass(array('required' => false)),
      'afip_envio'       => new sfValidatorPass(array('required' => false)),
      'afip_respuesta'   => new sfValidatorPass(array('required' => false)),
      'afip_mensaje'     => new sfValidatorPass(array('required' => false)),
      'pago_comision_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PagoComision'), 'column' => 'id')),
      'zona_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'presupuesto_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Presupuesto'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('resumen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resumen';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'fecha'            => 'Date',
      'tipo_venta_id'    => 'ForeignKey',
      'cliente_id'       => 'ForeignKey',
      'remito_id'        => 'ForeignKey',
      'lista_id'         => 'ForeignKey',
      'moneda_id'        => 'ForeignKey',
      'observacion'      => 'Text',
      'pagado'           => 'Number',
      'fecha_pagado'     => 'Date',
      'pedido_id'        => 'ForeignKey',
      'nro_factura'      => 'Number',
      'tipofactura_id'   => 'ForeignKey',
      'usuario'          => 'ForeignKey',
      'afip_estado'      => 'Number',
      'afip_cae'         => 'Text',
      'afip_vto_cae'     => 'Date',
      'pto_vta'          => 'Text',
      'afip_envio'       => 'Text',
      'afip_respuesta'   => 'Text',
      'afip_mensaje'     => 'Text',
      'pago_comision_id' => 'ForeignKey',
      'zona_id'          => 'ForeignKey',
      'presupuesto_id'   => 'ForeignKey',
    );
  }
}
