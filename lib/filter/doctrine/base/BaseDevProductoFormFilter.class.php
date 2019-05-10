<?php

/**
 * DevProducto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDevProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'resumen_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'cantidad'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'         => new sfWidgetFormFilterInput(),
      'total'          => new sfWidgetFormFilterInput(),
      'observacion'    => new sfWidgetFormFilterInput(),
      'nro_lote'       => new sfWidgetFormFilterInput(),
      'iva'            => new sfWidgetFormFilterInput(),
      'usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'afip_estado'    => new sfWidgetFormFilterInput(),
      'afip_cae'       => new sfWidgetFormFilterInput(),
      'afip_vto_cae'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pto_vta'        => new sfWidgetFormFilterInput(),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'nro_factura'    => new sfWidgetFormFilterInput(),
      'afip_envio'     => new sfWidgetFormFilterInput(),
      'afip_respuesta' => new sfWidgetFormFilterInput(),
      'lote_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'add_empty' => true)),
      'afip_mensaje'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'resumen_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'producto_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'cantidad'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'precio'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observacion'    => new sfValidatorPass(array('required' => false)),
      'nro_lote'       => new sfValidatorPass(array('required' => false)),
      'iva'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'usuario'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'afip_estado'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'afip_cae'       => new sfValidatorPass(array('required' => false)),
      'afip_vto_cae'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pto_vta'        => new sfValidatorPass(array('required' => false)),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoFactura'), 'column' => 'id')),
      'nro_factura'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'afip_envio'     => new sfValidatorPass(array('required' => false)),
      'afip_respuesta' => new sfValidatorPass(array('required' => false)),
      'lote_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lote'), 'column' => 'id')),
      'afip_mensaje'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dev_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DevProducto';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'fecha'          => 'Date',
      'cliente_id'     => 'ForeignKey',
      'resumen_id'     => 'ForeignKey',
      'producto_id'    => 'ForeignKey',
      'cantidad'       => 'Number',
      'precio'         => 'Number',
      'total'          => 'Number',
      'observacion'    => 'Text',
      'nro_lote'       => 'Text',
      'iva'            => 'Number',
      'usuario'        => 'ForeignKey',
      'afip_estado'    => 'Number',
      'afip_cae'       => 'Text',
      'afip_vto_cae'   => 'Date',
      'pto_vta'        => 'Text',
      'tipofactura_id' => 'ForeignKey',
      'nro_factura'    => 'Number',
      'afip_envio'     => 'Text',
      'afip_respuesta' => 'Text',
      'lote_id'        => 'ForeignKey',
      'afip_mensaje'   => 'Text',
    );
  }
}
