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
      'cliente_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'zona_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'prod_porc_desc'     => new sfWidgetFormFilterInput(),
      'grupo_porc_desc'    => new sfWidgetFormFilterInput(),
      'prod_precio_desc'   => new sfWidgetFormFilterInput(),
      'grupo_precio_desc'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'detalle_resumen_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DetalleResumen'), 'column' => 'id')),
      'resumen_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resumen'), 'column' => 'id')),
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'producto_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'cliente_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'zona_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'prod_porc_desc'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_porc_desc'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prod_precio_desc'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grupo_precio_desc'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'cliente_id'         => 'ForeignKey',
      'zona_id'            => 'ForeignKey',
      'prod_porc_desc'     => 'Number',
      'grupo_porc_desc'    => 'Number',
      'prod_precio_desc'   => 'Number',
      'grupo_precio_desc'  => 'Number',
    );
  }
}
