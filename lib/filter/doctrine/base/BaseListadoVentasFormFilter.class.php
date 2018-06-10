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
      'res_id'                   => new sfWidgetFormFilterInput(),
      'fecha'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'moneda_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'moneda_nombre'            => new sfWidgetFormFilterInput(),
      'cliente_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'cliente_apellido'         => new sfWidgetFormFilterInput(),
      'cliente_nombre'           => new sfWidgetFormFilterInput(),
      'tipo_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'tipo_cliente_nombre'      => new sfWidgetFormFilterInput(),
      'cliente_genera_comision'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'resumen_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'add_empty' => true)),
      'producto_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'                   => new sfWidgetFormFilterInput(),
      'cantidad'                 => new sfWidgetFormFilterInput(),
      'bonificados'              => new sfWidgetFormFilterInput(),
      'total'                    => new sfWidgetFormFilterInput(),
      'producto_nombre'          => new sfWidgetFormFilterInput(),
      'producto_genera_comision' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'grupoprod_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'grupo_nombre'             => new sfWidgetFormFilterInput(),
      'nro_lote'                 => new sfWidgetFormFilterInput(),
      'grupo2'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
      'fecha_vto'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'res_id'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'moneda_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'moneda_nombre'            => new sfValidatorPass(array('required' => false)),
      'cliente_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'cliente_apellido'         => new sfValidatorPass(array('required' => false)),
      'cliente_nombre'           => new sfValidatorPass(array('required' => false)),
      'tipo_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id')),
      'tipo_cliente_nombre'      => new sfValidatorPass(array('required' => false)),
      'cliente_genera_comision'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'resumen_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Detalle'), 'column' => 'id')),
      'producto_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'                   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bonificados'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'producto_nombre'          => new sfValidatorPass(array('required' => false)),
      'producto_genera_comision' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'grupoprod_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'grupo_nombre'             => new sfValidatorPass(array('required' => false)),
      'nro_lote'                 => new sfValidatorPass(array('required' => false)),
      'grupo2'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoDos'), 'column' => 'id')),
      'grupo3'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoTres'), 'column' => 'id')),
      'fecha_vto'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
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
      'id'                       => 'Number',
      'res_id'                   => 'Number',
      'fecha'                    => 'Date',
      'moneda_id'                => 'ForeignKey',
      'moneda_nombre'            => 'Text',
      'cliente_id'               => 'ForeignKey',
      'cliente_apellido'         => 'Text',
      'cliente_nombre'           => 'Text',
      'tipo_id'                  => 'ForeignKey',
      'tipo_cliente_nombre'      => 'Text',
      'cliente_genera_comision'  => 'Boolean',
      'resumen_id'               => 'ForeignKey',
      'producto_id'              => 'ForeignKey',
      'precio'                   => 'Number',
      'cantidad'                 => 'Number',
      'bonificados'              => 'Number',
      'total'                    => 'Number',
      'producto_nombre'          => 'Text',
      'producto_genera_comision' => 'Boolean',
      'grupoprod_id'             => 'ForeignKey',
      'grupo_nombre'             => 'Text',
      'nro_lote'                 => 'Text',
      'grupo2'                   => 'ForeignKey',
      'grupo3'                   => 'ForeignKey',
      'fecha_vto'                => 'Date',
    );
  }
}
