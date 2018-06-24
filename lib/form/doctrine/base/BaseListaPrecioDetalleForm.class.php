<?php

/**
 * ListaPrecioDetalle form base class.
 *
 * @method ListaPrecioDetalle getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListaPrecioDetalleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'lista_id'          => new sfWidgetFormInputText(),
      'nombre'            => new sfWidgetFormInputText(),
      'moneda_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'grupo_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_grupo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoGrupo'), 'add_empty' => true)),
      'producto_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lista_id'          => new sfValidatorInteger(array('required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'moneda_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'grupo_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'producto_grupo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoGrupo'), 'required' => false)),
      'producto_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'precio'            => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lista_precio_detalle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListaPrecioDetalle';
  }

}
