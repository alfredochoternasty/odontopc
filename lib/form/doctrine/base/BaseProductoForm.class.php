<?php

/**
 * Producto form base class.
 *
 * @method Producto getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'codigo'          => new sfWidgetFormInputText(),
      'nombre'          => new sfWidgetFormInputText(),
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'precio_vta'      => new sfWidgetFormInputText(),
      'moneda_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'genera_comision' => new sfWidgetFormInputCheckbox(),
      'mueve_stock'     => new sfWidgetFormInputCheckbox(),
      'minimo_stock'    => new sfWidgetFormInputText(),
      'stock_actual'    => new sfWidgetFormInputText(),
      'ctr_fact_grupo'  => new sfWidgetFormInputCheckbox(),
      'orden_grupo'     => new sfWidgetFormInputText(),
      'activo'          => new sfWidgetFormInputCheckbox(),
      'grupo2'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
      'lista_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'foto'            => new sfWidgetFormInputText(),
      'descripcion'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'codigo'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nombre'          => new sfValidatorString(array('max_length' => 100)),
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'precio_vta'      => new sfValidatorNumber(array('required' => false)),
      'moneda_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'genera_comision' => new sfValidatorBoolean(array('required' => false)),
      'mueve_stock'     => new sfValidatorBoolean(array('required' => false)),
      'minimo_stock'    => new sfValidatorInteger(array('required' => false)),
      'stock_actual'    => new sfValidatorInteger(array('required' => false)),
      'ctr_fact_grupo'  => new sfValidatorBoolean(array('required' => false)),
      'orden_grupo'     => new sfValidatorInteger(array('required' => false)),
      'activo'          => new sfValidatorBoolean(array('required' => false)),
      'grupo2'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'required' => false)),
      'grupo3'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'required' => false)),
      'lista_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'required' => false)),
      'foto'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'descripcion'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }

}
