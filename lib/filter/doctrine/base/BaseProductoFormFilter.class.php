<?php

/**
 * Producto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo'          => new sfWidgetFormFilterInput(),
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'precio_vta'      => new sfWidgetFormFilterInput(),
      'moneda_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'genera_comision' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mueve_stock'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'minimo_stock'    => new sfWidgetFormFilterInput(),
      'stock_actual'    => new sfWidgetFormFilterInput(),
      'ctr_fact_grupo'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'orden_grupo'     => new sfWidgetFormFilterInput(),
      'activo'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'grupo2'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
      'lista_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'foto'            => new sfWidgetFormFilterInput(),
      'descripcion'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'codigo'          => new sfValidatorPass(array('required' => false)),
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'precio_vta'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'moneda_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'genera_comision' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mueve_stock'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'minimo_stock'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_actual'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ctr_fact_grupo'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'orden_grupo'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'activo'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'grupo2'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoDos'), 'column' => 'id')),
      'grupo3'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GrupoTres'), 'column' => 'id')),
      'lista_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'foto'            => new sfValidatorPass(array('required' => false)),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'codigo'          => 'Text',
      'nombre'          => 'Text',
      'grupoprod_id'    => 'ForeignKey',
      'precio_vta'      => 'Number',
      'moneda_id'       => 'ForeignKey',
      'genera_comision' => 'Boolean',
      'mueve_stock'     => 'Boolean',
      'minimo_stock'    => 'Number',
      'stock_actual'    => 'Number',
      'ctr_fact_grupo'  => 'Boolean',
      'orden_grupo'     => 'Number',
      'activo'          => 'Boolean',
      'grupo2'          => 'ForeignKey',
      'grupo3'          => 'ForeignKey',
      'lista_id'        => 'ForeignKey',
      'foto'            => 'Text',
      'descripcion'     => 'Text',
    );
  }
}
