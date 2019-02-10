<?php

/**
 * DetalleCompra form base class.
 *
 * @method DetalleCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetalleCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'compra_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => false)),
      'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => false)),
      'precio'      => new sfWidgetFormInputText(),
      'cantidad'    => new sfWidgetFormInputText(),
      'total'       => new sfWidgetFormInputText(),
      'observacion' => new sfWidgetFormInputText(),
      'nro_lote'    => new sfWidgetFormInputText(),
      'fecha_vto'   => new sfWidgetFormDate(),
      'iva'         => new sfWidgetFormInputText(),
      'sub_total'   => new sfWidgetFormInputText(),
      'trazable'    => new sfWidgetFormInputCheckbox(),
      'usuario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'tiene_vto'   => new sfWidgetFormInputCheckbox(),
      'lote_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'compra_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'))),
      'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'))),
      'precio'      => new sfValidatorNumber(array('required' => false)),
      'cantidad'    => new sfValidatorInteger(array('required' => false)),
      'total'       => new sfValidatorNumber(array('required' => false)),
      'observacion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nro_lote'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fecha_vto'   => new sfValidatorDate(array('required' => false)),
      'iva'         => new sfValidatorNumber(array('required' => false)),
      'sub_total'   => new sfValidatorNumber(array('required' => false)),
      'trazable'    => new sfValidatorBoolean(array('required' => false)),
      'usuario'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'tiene_vto'   => new sfValidatorBoolean(array('required' => false)),
      'lote_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleCompra';
  }

}
