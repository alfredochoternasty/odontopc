<?php

/**
 * MovimientoProducto form base class.
 *
 * @method MovimientoProducto getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMovimientoProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'resumen_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'tipofactura_id' => new sfWidgetFormInputText(),
      'fecha'          => new sfWidgetFormDate(),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'orden_grupo'    => new sfWidgetFormInputText(),
      'nombre'         => new sfWidgetFormInputText(),
      'nro_lote'       => new sfWidgetFormInputText(),
      'cantidad'       => new sfWidgetFormInputText(),
      'bonificados'    => new sfWidgetFormInputText(),
      'precio'         => new sfWidgetFormInputText(),
      'iva'            => new sfWidgetFormInputText(),
      'sub_total'      => new sfWidgetFormInputText(),
      'total'          => new sfWidgetFormInputText(),
      'det_remito_id'  => new sfWidgetFormInputText(),
      'cant_dev'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'resumen_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'required' => false)),
      'tipofactura_id' => new sfValidatorInteger(array('required' => false)),
      'fecha'          => new sfValidatorDate(array('required' => false)),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'zona_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'producto_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'grupoprod_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'orden_grupo'    => new sfValidatorInteger(array('required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nro_lote'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cantidad'       => new sfValidatorNumber(array('required' => false)),
      'bonificados'    => new sfValidatorNumber(array('required' => false)),
      'precio'         => new sfValidatorNumber(array('required' => false)),
      'iva'            => new sfValidatorNumber(array('required' => false)),
      'sub_total'      => new sfValidatorNumber(array('required' => false)),
      'total'          => new sfValidatorNumber(array('required' => false)),
      'det_remito_id'  => new sfValidatorInteger(array('required' => false)),
      'cant_dev'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movimiento_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovimientoProducto';
  }

}