<?php

/**
 * ListaPrecioDetalle filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListaPrecioDetalleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'lista_id'          => new sfWidgetFormFilterInput(),
      'nombre'            => new sfWidgetFormFilterInput(),
      'moneda_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'grupo_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_grupo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoGrupo'), 'add_empty' => true)),
      'producto_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'lista_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'moneda_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moneda'), 'column' => 'id')),
      'grupo_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
      'producto_grupo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoGrupo'), 'column' => 'id')),
      'producto_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'precio'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lista_precio_detalle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListaPrecioDetalle';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'lista_id'          => 'Number',
      'nombre'            => 'Text',
      'moneda_id'         => 'ForeignKey',
      'grupo_id'          => 'ForeignKey',
      'producto_grupo_id' => 'ForeignKey',
      'producto_id'       => 'ForeignKey',
      'precio'            => 'Number',
    );
  }
}
