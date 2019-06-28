<?php

/**
 * VentasZona form base class.
 *
 * @method VentasZona getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVentasZonaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'detalle_resumen_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DetalleResumen'), 'add_empty' => true)),
      'resumen_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => true)),
      'fecha'              => new sfWidgetFormDate(),
      'producto_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'grupoprod_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'nro_lote'           => new sfWidgetFormInputText(),
      'cliente_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'zona_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'prod_porc_desc'     => new sfWidgetFormInputText(),
      'grupo_porc_desc'    => new sfWidgetFormInputText(),
      'prod_precio_desc'   => new sfWidgetFormInputText(),
      'grupo_precio_desc'  => new sfWidgetFormInputText(),
      'cobrado'            => new sfWidgetFormInputCheckbox(),
      'fecha_cobrado'      => new sfWidgetFormDate(),
      'pago_comision_id'   => new sfWidgetFormInputText(),
      'pagado'             => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'detalle_resumen_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DetalleResumen'), 'required' => false)),
      'resumen_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'required' => false)),
      'fecha'              => new sfValidatorDate(array('required' => false)),
      'producto_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
      'grupoprod_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'nro_lote'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cliente_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'zona_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'prod_porc_desc'     => new sfValidatorInteger(array('required' => false)),
      'grupo_porc_desc'    => new sfValidatorInteger(array('required' => false)),
      'prod_precio_desc'   => new sfValidatorInteger(array('required' => false)),
      'grupo_precio_desc'  => new sfValidatorInteger(array('required' => false)),
      'cobrado'            => new sfValidatorBoolean(array('required' => false)),
      'fecha_cobrado'      => new sfValidatorDate(array('required' => false)),
      'pago_comision_id'   => new sfValidatorInteger(array('required' => false)),
      'pagado'             => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ventas_zona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VentasZona';
  }

}
