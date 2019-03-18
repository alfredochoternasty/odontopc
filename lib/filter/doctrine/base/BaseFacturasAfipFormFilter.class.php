<?php

/**
 * FacturasAfip filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFacturasAfipFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'pto_vta'        => new sfWidgetFormFilterInput(),
      'nro_factura'    => new sfWidgetFormFilterInput(),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'cae'            => new sfWidgetFormFilterInput(),
      'iva'            => new sfWidgetFormFilterInput(),
      'neto'           => new sfWidgetFormFilterInput(),
      'total'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoFactura'), 'column' => 'id')),
      'pto_vta'        => new sfValidatorPass(array('required' => false)),
      'nro_factura'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'cae'            => new sfValidatorPass(array('required' => false)),
      'iva'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'neto'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('facturas_afip_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacturasAfip';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'tipofactura_id' => 'ForeignKey',
      'pto_vta'        => 'Text',
      'nro_factura'    => 'Number',
      'fecha'          => 'Date',
      'cliente_id'     => 'ForeignKey',
      'cae'            => 'Text',
      'iva'            => 'Number',
      'neto'           => 'Number',
      'total'          => 'Number',
    );
  }
}
