<?php

/**
 * DetallePresupuesto form base class.
 *
 * @method DetallePresupuesto getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetallePresupuestoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'presupuesto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'), 'add_empty' => false)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => false)),
      'cantidad'       => new sfWidgetFormInputText(),
      'precio'         => new sfWidgetFormInputText(),
      'total'          => new sfWidgetFormInputText(),
      'iva'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'presupuesto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Presupuesto'))),
      'producto_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'))),
      'cantidad'       => new sfValidatorInteger(array('required' => false)),
      'precio'         => new sfValidatorNumber(array('required' => false)),
      'total'          => new sfValidatorNumber(array('required' => false)),
      'iva'            => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_presupuesto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetallePresupuesto';
  }

}
