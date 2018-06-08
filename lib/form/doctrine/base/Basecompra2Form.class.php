<?php

/**
 * compra2 form base class.
 *
 * @method compra2 getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basecompra2Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'numero_compra' => new sfWidgetFormInputText(),
      'proveedor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'fecha'         => new sfWidgetFormDate(),
      'producto_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto2'), 'add_empty' => true)),
      'cantidad'      => new sfWidgetFormInputText(),
      'nro_lote'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero_compra' => new sfValidatorInteger(array('required' => false)),
      'proveedor_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'fecha'         => new sfValidatorDate(array('required' => false)),
      'producto_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto2'), 'required' => false)),
      'cantidad'      => new sfValidatorInteger(array('required' => false)),
      'nro_lote'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('compra2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'compra2';
  }

}
