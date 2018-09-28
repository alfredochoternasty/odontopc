<?php

/**
 * ListadoCompras form base class.
 *
 * @method ListadoCompras getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListadoComprasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'compra_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'add_empty' => true)),
      'numero'          => new sfWidgetFormInputText(),
      'fecha'           => new sfWidgetFormDate(),
      'moneda_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'moneda_nombre'   => new sfWidgetFormInputText(),
      'prov_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'prov_raz_soc'    => new sfWidgetFormInputText(),
      'producto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'          => new sfWidgetFormInputText(),
      'cantidad'        => new sfWidgetFormInputText(),
      'total'           => new sfWidgetFormInputText(),
      'producto_nombre' => new sfWidgetFormInputText(),
      'grupoprod_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'grupo_nombre'    => new sfWidgetFormInputText(),
      'nro_lote'        => new sfWidgetFormInputText(),
      'grupo2'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'add_empty' => true)),
      'grupo3'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'compra_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Detalle'), 'required' => false)),
      'numero'          => new sfValidatorInteger(array('required' => false)),
      'fecha'           => new sfValidatorDate(),
      'moneda_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'moneda_nombre'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'prov_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'prov_raz_soc'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'producto_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'precio'          => new sfValidatorNumber(array('required' => false)),
      'cantidad'        => new sfValidatorInteger(array('required' => false)),
      'total'           => new sfValidatorNumber(array('required' => false)),
      'producto_nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'grupoprod_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'grupo_nombre'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nro_lote'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'grupo2'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoDos'), 'required' => false)),
      'grupo3'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GrupoTres'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listado_compras[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoCompras';
  }

}
