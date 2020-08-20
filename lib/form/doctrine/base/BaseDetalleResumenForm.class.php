<?php

/**
 * DetalleResumen form base class.
 *
 * @method DetalleResumen getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetalleResumenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'resumen_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => false)),
      'producto_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => false)),
      'precio'           => new sfWidgetFormInputText(),
      'cantidad'         => new sfWidgetFormInputText(),
      'total'            => new sfWidgetFormInputText(),
      'bonificados'      => new sfWidgetFormInputText(),
      'observacion'      => new sfWidgetFormInputText(),
      'nro_lote'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'add_empty' => true)),
      'fecha_vto'        => new sfWidgetFormDate(),
      'iva'              => new sfWidgetFormInputText(),
      'sub_total'        => new sfWidgetFormInputText(),
      'usuario'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'lista_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => false)),
      'moneda_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'cant_vend_remito' => new sfWidgetFormInputText(),
      'lote_id'          => new sfWidgetFormInputText(),
      'det_remito_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DetalleRemito'), 'add_empty' => true)),
      'descuento'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'resumen_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'))),
      'producto_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'))),
      'precio'           => new sfValidatorNumber(array('required' => false)),
      'cantidad'         => new sfValidatorInteger(array('required' => false)),
      'total'            => new sfValidatorNumber(array('required' => false)),
      'bonificados'      => new sfValidatorInteger(array('required' => false)),
      'observacion'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nro_lote'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lote'), 'required' => false)),
      'fecha_vto'        => new sfValidatorDate(),
      'iva'              => new sfValidatorNumber(array('required' => false)),
      'sub_total'        => new sfValidatorNumber(array('required' => false)),
      'usuario'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'lista_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'))),
      'moneda_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'))),
      'cant_vend_remito' => new sfValidatorInteger(array('required' => false)),
      'lote_id'          => new sfValidatorInteger(array('required' => false)),
      'det_remito_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DetalleRemito'), 'required' => false)),
      'descuento'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_resumen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleResumen';
  }

}
