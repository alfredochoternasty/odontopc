<?php

/**
 * ListadoVentas form base class.
 *
 * @method ListadoVentas getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListadoVentasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'res_id'                   => new sfWidgetFormInputText(),
      'fecha'                    => new sfWidgetFormDate(),
      'moneda_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'moneda_nombre'            => new sfWidgetFormInputText(),
      'cliente_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'cliente_apellido'         => new sfWidgetFormInputText(),
      'cliente_nombre'           => new sfWidgetFormInputText(),
      'tipo_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'tipo_cliente_nombre'      => new sfWidgetFormInputText(),
      'cliente_genera_comision'  => new sfWidgetFormInputCheckbox(),
      'resumen_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'add_empty' => true)),
      'producto_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'                   => new sfWidgetFormInputText(),
      'cantidad'                 => new sfWidgetFormInputText(),
      'bonificados'              => new sfWidgetFormInputText(),
      'total'                    => new sfWidgetFormInputText(),
      'producto_nombre'          => new sfWidgetFormInputText(),
      'producto_genera_comision' => new sfWidgetFormInputCheckbox(),
      'grupoprod_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'grupo_nombre'             => new sfWidgetFormInputText(),
      'nro_lote'                 => new sfWidgetFormInputText(),
      'grupo2'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'res_id'                   => new sfValidatorInteger(array('required' => false)),
      'fecha'                    => new sfValidatorDate(),
      'moneda_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'moneda_nombre'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cliente_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'cliente_apellido'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cliente_nombre'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tipo_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'required' => false)),
      'tipo_cliente_nombre'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'cliente_genera_comision'  => new sfValidatorBoolean(array('required' => false)),
      'resumen_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'required' => false)),
      'producto_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'precio'                   => new sfValidatorNumber(array('required' => false)),
      'cantidad'                 => new sfValidatorInteger(array('required' => false)),
      'bonificados'              => new sfValidatorInteger(array('required' => false)),
      'total'                    => new sfValidatorNumber(array('required' => false)),
      'producto_nombre'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'producto_genera_comision' => new sfValidatorBoolean(array('required' => false)),
      'grupoprod_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'grupo_nombre'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nro_lote'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'grupo2'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'required' => false)),
      'grupo3'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listado_ventas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoVentas';
  }

}
