<?php

/**
 * Lote form base class.
 *
 * @method Lote getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'nro_lote'    => new sfWidgetFormInputText(),
      'stock'       => new sfWidgetFormInputText(),
      'fecha_vto'   => new sfWidgetFormDate(),
      'compra_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'observacion' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'nro_lote'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'stock'       => new sfValidatorInteger(array('required' => false)),
      'fecha_vto'   => new sfValidatorDate(array('required' => false)),
      'compra_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'required' => false)),
      'observacion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lote';
  }

}
