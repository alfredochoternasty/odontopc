<?php

/**
 * ListadoVentas filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListadoVentasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'resumen_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'orden_grupo'    => new sfWidgetFormFilterInput(),
      'nombre'         => new sfWidgetFormFilterInput(),
      'nro_lote'       => new sfWidgetFormFilterInput(),
      'cantidad'       => new sfWidgetFormFilterInput(),
      'bonificados'    => new sfWidgetFormFilterInput(),
      'precio'         => new sfWidgetFormFilterInput(),
      'iva'            => new sfWidgetFormFilterInput(),
      'sub_total'      => new sfWidgetFormFilterInput(),
      'total'          => new sfWidgetFormFilterInput(),
      'det_remito_id'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'resumen_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoFactura'), 'column' => 'id')),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'zona_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'producto_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'orden_grupo'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'         => new sfValidatorPass(array('required' => false)),
      'nro_lote'       => new sfValidatorPass(array('required' => false)),
      'cantidad'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'bonificados'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'precio'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'iva'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sub_total'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'det_remito_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('listado_ventas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoVentas';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'resumen_id'     => 'ForeignKey',
      'tipofactura_id' => 'ForeignKey',
      'fecha'          => 'Date',
      'cliente_id'     => 'ForeignKey',
      'zona_id'        => 'ForeignKey',
      'producto_id'    => 'ForeignKey',
      'grupoprod_id'   => 'ForeignKey',
      'orden_grupo'    => 'Number',
      'nombre'         => 'Text',
      'nro_lote'       => 'Text',
      'cantidad'       => 'Number',
      'bonificados'    => 'Number',
      'precio'         => 'Number',
      'iva'            => 'Number',
      'sub_total'      => 'Number',
      'total'          => 'Number',
      'det_remito_id'  => 'Number',
    );
  }
}
