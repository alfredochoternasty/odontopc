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
      'id'           => new sfWidgetFormInputHidden(),
      'compra_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => true)),
      'fecha'        => new sfWidgetFormDate(),
      'proveedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'producto_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'precio'       => new sfWidgetFormInputText(),
      'cantidad'     => new sfWidgetFormInputText(),
      'total'        => new sfWidgetFormInputText(),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'nro_lote'     => new sfWidgetFormInputText(),
      'zona_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'compra_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'required' => false)),
      'fecha'        => new sfValidatorDate(),
      'proveedor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'producto_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'precio'       => new sfValidatorNumber(array('required' => false)),
      'cantidad'     => new sfValidatorInteger(array('required' => false)),
      'total'        => new sfValidatorNumber(array('required' => false)),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'nro_lote'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'zona_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
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
