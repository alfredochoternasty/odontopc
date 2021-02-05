<?php

/**
 * Presupuesto form base class.
 *
 * @method Presupuesto getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePresupuestoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'fecha'       => new sfWidgetFormDate(),
      'lista_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false)),
      'descripcion' => new sfWidgetFormInputText(),
      'zona_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'email'       => new sfWidgetFormInputText(),
      'telefono'    => new sfWidgetFormInputText(),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'vendido'     => new sfWidgetFormInputText(),
      'fecha_venta' => new sfWidgetFormDate(),
      'usuario_id'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'       => new sfValidatorDate(),
      'lista_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'))),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'zona_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefono'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'vendido'     => new sfValidatorInteger(array('required' => false)),
      'fecha_venta' => new sfValidatorDate(),
      'usuario_id'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('presupuesto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Presupuesto';
  }

}
