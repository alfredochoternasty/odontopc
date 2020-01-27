<?php

/**
 * TipoFactura form base class.
 *
 * @method TipoFactura getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoFacturaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'cod_tipo_afip'    => new sfWidgetFormInputText(),
      'letra'            => new sfWidgetFormInputText(),
      'id_fact_cancela'  => new sfWidgetFormInputText(),
      'modelo_impresion' => new sfWidgetFormInputText(),
      'cond_fiscales'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 50)),
      'cod_tipo_afip'    => new sfValidatorInteger(array('required' => false)),
      'letra'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_fact_cancela'  => new sfValidatorInteger(array('required' => false)),
      'modelo_impresion' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cond_fiscales'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_factura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoFactura';
  }

}
