<?php

/**
 * Pedido form base class.
 *
 * @method Pedido getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePedidoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'fecha'                => new sfWidgetFormDate(),
      'cliente_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'observacion'          => new sfWidgetFormInputText(),
      'vendido'              => new sfWidgetFormInputText(),
      'fecha_venta'          => new sfWidgetFormDate(),
      'direccion_entrega'    => new sfWidgetFormInputText(),
      'forma_envio'          => new sfWidgetFormInputText(),
      'finalizado'           => new sfWidgetFormInputText(),
      'cliente_domicilio_id' => new sfWidgetFormInputText(),
      'zona_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'usuario_id'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'                => new sfValidatorDate(),
      'cliente_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'observacion'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'vendido'              => new sfValidatorInteger(array('required' => false)),
      'fecha_venta'          => new sfValidatorDate(),
      'direccion_entrega'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'forma_envio'          => new sfValidatorInteger(),
      'finalizado'           => new sfValidatorInteger(),
      'cliente_domicilio_id' => new sfValidatorInteger(array('required' => false)),
      'zona_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'usuario_id'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pedido[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pedido';
  }

}
