<?php

/**
 * VentasZona filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVentasZonaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'detalle_resumen_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DetalleResumen'), 'add_empty' => true)),
      'resumen_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'fecha'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'producto_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'nro_lote'           => new sfWidgetFormFilterInput(),
      'cliente_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'zona_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'prod_porc_desc'     => new sfWidgetFormFilterInput(),
      'grupo_porc_desc'    => new sfWidgetFormFilterInput(),
      'prod_precio_desc'   => new sfWidgetFormFilterInput(),
      'grupo_precio_desc'  => new sfWidgetFormFilterInput(),
      'cobrado'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_cobrado'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pago_comision_id'   => new sfWidgetFormFilterInput(),
      'pagado'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'detalle_resumen_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DetalleResumen'), 'column' => 'id')),
      'resumen_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'producto_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'grupoprod_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'nro_lote'           => new sfValidatorPass(array('required' => false)),
      'cliente_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'zona_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'prod_porc_desc'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_porc_desc'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prod_precio_desc'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_precio_desc'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cobrado'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_cobrado'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pago_comision_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pagado'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('ventas_zona_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VentasZona';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'detalle_resumen_id' => 'ForeignKey',
      'resumen_id'         => 'ForeignKey',
      'fecha'              => 'Date',
      'producto_id'        => 'ForeignKey',
      'grupoprod_id'       => 'ForeignKey',
      'nro_lote'           => 'Text',
      'cliente_id'         => 'ForeignKey',
      'zona_id'            => 'ForeignKey',
      'prod_porc_desc'     => 'Number',
      'grupo_porc_desc'    => 'Number',
      'prod_precio_desc'   => 'Number',
      'grupo_precio_desc'  => 'Number',
      'cobrado'            => 'Boolean',
      'fecha_cobrado'      => 'Date',
      'pago_comision_id'   => 'Number',
      'pagado'             => 'Boolean',
    );
  }
}
