<?php

/**
 * ClienteSaldo form base class.
 *
 * @method ClienteSaldo getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteSaldoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'apellido'  => new sfWidgetFormInputText(),
      'nombre'    => new sfWidgetFormInputText(),
      'moneda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'saldo'     => new sfWidgetFormInputText(),
      'zona_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'ult_cobro' => new sfWidgetFormDate(),
      'ult_venta' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'apellido'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nombre'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'moneda_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'saldo'     => new sfValidatorNumber(),
      'zona_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'ult_cobro' => new sfValidatorDate(array('required' => false)),
      'ult_venta' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_saldo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteSaldo';
  }

}
