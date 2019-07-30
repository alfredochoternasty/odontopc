<?php

/**
 * ListadoCompras filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListadoComprasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'compra_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'fecha'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'proveedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'       => new sfWidgetFormFilterInput(),
      'cantidad'     => new sfWidgetFormFilterInput(),
      'total'        => new sfWidgetFormFilterInput(),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'nro_lote'     => new sfWidgetFormFilterInput(),
      'zona_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'compra_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Compra'), 'column' => 'id')),
      'fecha'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'proveedor_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'producto_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'nro_lote'     => new sfValidatorPass(array('required' => false)),
      'zona_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('listado_compras_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoCompras';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'compra_id'    => 'ForeignKey',
      'fecha'        => 'Date',
      'proveedor_id' => 'ForeignKey',
      'producto_id'  => 'ForeignKey',
      'precio'       => 'Number',
      'cantidad'     => 'Number',
      'total'        => 'Number',
      'grupoprod_id' => 'ForeignKey',
      'nro_lote'     => 'Text',
      'zona_id'      => 'ForeignKey',
    );
  }
}
