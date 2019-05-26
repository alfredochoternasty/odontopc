<?php

/**
 * DevProducto form base class.
 *
 * @method DevProducto getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDevProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'fecha'          => new sfWidgetFormDate(),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'resumen_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => false)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => false)),
      'cantidad'       => new sfWidgetFormInputText(),
      'precio'         => new sfWidgetFormInputText(),
      'total'          => new sfWidgetFormInputText(),
      'observacion'    => new sfWidgetFormInputText(),
      'nro_lote'       => new sfWidgetFormInputText(),
      'iva'            => new sfWidgetFormInputText(),
      'usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'afip_estado'    => new sfWidgetFormInputText(),
      'afip_cae'       => new sfWidgetFormInputText(),
      'afip_vto_cae'   => new sfWidgetFormDate(),
      'pto_vta'        => new sfWidgetFormInputText(),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'nro_factura'    => new sfWidgetFormInputText(),
      'afip_envio'     => new sfWidgetFormTextarea(),
      'afip_respuesta' => new sfWidgetFormTextarea(),
      'lote_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'add_empty' => true)),
      'afip_mensaje'   => new sfWidgetFormInputText(),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'          => new sfValidatorDate(),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'resumen_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'))),
      'producto_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'))),
      'cantidad'       => new sfValidatorInteger(array('required' => false)),
      'precio'         => new sfValidatorNumber(array('required' => false)),
      'total'          => new sfValidatorNumber(array('required' => false)),
      'observacion'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nro_lote'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'iva'            => new sfValidatorNumber(array('required' => false)),
      'usuario'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'afip_estado'    => new sfValidatorInteger(array('required' => false)),
      'afip_cae'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'afip_vto_cae'   => new sfValidatorDate(array('required' => false)),
      'pto_vta'        => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'required' => false)),
      'nro_factura'    => new sfValidatorInteger(array('required' => false)),
      'afip_envio'     => new sfValidatorString(array('required' => false)),
      'afip_respuesta' => new sfValidatorString(array('required' => false)),
      'lote_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'required' => false)),
      'afip_mensaje'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'zona_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dev_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DevProducto';
  }

}
