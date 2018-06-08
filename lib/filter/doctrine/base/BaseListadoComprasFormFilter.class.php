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
      'compra_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'add_empty' => true)),
      'numero'          => new sfWidgetFormFilterInput(),
      'fecha'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'moneda_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'moneda_nombre'   => new sfWidgetFormFilterInput(),
      'prov_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'prov_raz_soc'    => new sfWidgetFormFilterInput(),
      'producto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'          => new sfWidgetFormFilterInput(),
      'cantidad'        => new sfWidgetFormFilterInput(),
      'total'           => new sfWidgetFormFilterInput(),
      'producto_nombre' => new sfWidgetFormFilterInput(),
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'grupo_nombre'    => new sfWidgetFormFilterInput(),
      'nro_lote'        => new sfWidgetFormFilterInput(),
      'grupo2'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'compra_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Detalle'), 'column' => 'id')),
      'numero'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'moneda_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'moneda_nombre'   => new sfValidatorPass(array('required' => false)),
      'prov_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id')),
      'prov_raz_soc'    => new sfValidatorPass(array('required' => false)),
      'producto_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'producto_nombre' => new sfValidatorPass(array('required' => false)),
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'grupo_nombre'    => new sfValidatorPass(array('required' => false)),
      'nro_lote'        => new sfValidatorPass(array('required' => false)),
      'grupo2'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoDos'), 'column' => 'id')),
      'grupo3'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoTres'), 'column' => 'id')),
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
      'id'              => 'Number',
      'compra_id'       => 'ForeignKey',
      'numero'          => 'Number',
      'fecha'           => 'Date',
      'moneda_id'       => 'ForeignKey',
      'moneda_nombre'   => 'Text',
      'prov_id'         => 'ForeignKey',
      'prov_raz_soc'    => 'Text',
      'producto_id'     => 'ForeignKey',
      'precio'          => 'Number',
      'cantidad'        => 'Number',
      'total'           => 'Number',
      'producto_nombre' => 'Text',
      'grupoprod_id'    => 'ForeignKey',
      'grupo_nombre'    => 'Text',
      'nro_lote'        => 'Text',
      'grupo2'          => 'ForeignKey',
      'grupo3'          => 'ForeignKey',
    );
  }
}
