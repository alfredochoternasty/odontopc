<?php

/**
 * ControlStock form base class.
 *
 * @method ControlStock getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseControlStockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'producto_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'producto_nombre'      => new sfWidgetFormInputText(),
      'resumen_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'fecha_vta'            => new sfWidgetFormDate(),
      'nro_lote'             => new sfWidgetFormInputText(),
      'cantidad_vendida'     => new sfWidgetFormInputText(),
      'cantidad_bonificados' => new sfWidgetFormInputText(),
      'cantidad_total'       => new sfWidgetFormInputText(),
      'stock_actual'         => new sfWidgetFormInputText(),
      'stock_sin_lote'       => new sfWidgetFormDate(),
      'grupo2'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'producto_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'grupoprod_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'producto_nombre'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'resumen_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'required' => false)),
      'fecha_vta'            => new sfValidatorDate(array('required' => false)),
      'nro_lote'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cantidad_vendida'     => new sfValidatorInteger(array('required' => false)),
      'cantidad_bonificados' => new sfValidatorInteger(array('required' => false)),
      'cantidad_total'       => new sfValidatorInteger(array('required' => false)),
      'stock_actual'         => new sfValidatorInteger(array('required' => false)),
      'stock_sin_lote'       => new sfValidatorDate(array('required' => false)),
      'grupo2'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'required' => false)),
      'grupo3'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('control_stock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ControlStock';
  }

}
