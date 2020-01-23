<?php

/**
 * Cobro form base class.
 *
 * @method Cobro getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCobroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'fecha'       => new sfWidgetFormDate(),
      'cliente_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'resumen_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'), 'add_empty' => false)),
      'moneda_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'monto'       => new sfWidgetFormInputText(),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'banco_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true)),
      'numero'      => new sfWidgetFormInputText(),
      'fecha_vto'   => new sfWidgetFormDate(),
      'devprod_id'  => new sfWidgetFormInputText(),
      'observacion' => new sfWidgetFormInputText(),
      'usuario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'nro_recibo'  => new sfWidgetFormInputText(),
      'zona_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'archivo'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'       => new sfValidatorDate(),
      'cliente_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'resumen_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resumen'))),
      'moneda_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'monto'       => new sfValidatorNumber(array('required' => false)),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'banco_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'required' => false)),
      'numero'      => new sfValidatorInteger(array('required' => false)),
      'fecha_vto'   => new sfValidatorDate(array('required' => false)),
      'devprod_id'  => new sfValidatorInteger(array('required' => false)),
      'observacion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'usuario'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'nro_recibo'  => new sfValidatorInteger(array('required' => false)),
      'zona_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
      'archivo'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cobro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cobro';
  }

}
