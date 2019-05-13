<?php

/**
 * FacturasAfip form base class.
 *
 * @method FacturasAfip getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacturasAfipForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => true)),
      'pto_vta'        => new sfWidgetFormInputText(),
      'nro_factura'    => new sfWidgetFormInputText(),
      'fecha'          => new sfWidgetFormDate(),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'cae'            => new sfWidgetFormInputText(),
      'iva'            => new sfWidgetFormInputText(),
      'neto'           => new sfWidgetFormInputText(),
      'total'          => new sfWidgetFormInputText(),
      'cliente'        => new sfWidgetFormInputText(),
      'zona_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'required' => false)),
      'pto_vta'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nro_factura'    => new sfValidatorInteger(array('required' => false)),
      'fecha'          => new sfValidatorDate(array('required' => false)),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'cae'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'iva'            => new sfValidatorNumber(array('required' => false)),
      'neto'           => new sfValidatorNumber(array('required' => false)),
      'total'          => new sfValidatorNumber(array('required' => false)),
      'cliente'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'zona_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facturas_afip[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacturasAfip';
  }

}
