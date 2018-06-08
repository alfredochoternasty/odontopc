<?php

/**
 * Resumen form base class.
 *
 * @method Resumen getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResumenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'fecha'          => new sfWidgetFormDate(),
      'cliente_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'lista_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false)),
      'moneda_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'observacion'    => new sfWidgetFormInputText(),
      'pagado'         => new sfWidgetFormInputText(),
      'pedido_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pedido'), 'add_empty' => true)),
      'nro_factura'    => new sfWidgetFormInputText(),
      'tipofactura_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'          => new sfValidatorDate(),
      'cliente_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'lista_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'))),
      'moneda_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'observacion'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'pagado'         => new sfValidatorInteger(array('required' => false)),
      'pedido_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pedido'), 'required' => false)),
      'nro_factura'    => new sfValidatorInteger(array('required' => false)),
      'tipofactura_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'))),
    ));

    $this->widgetSchema->setNameFormat('resumen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resumen';
  }

}
