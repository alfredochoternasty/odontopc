<?php

/**
 * ListadoCobros form base class.
 *
 * @method ListadoCobros getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListadoCobrosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha'         => new sfWidgetFormDate(),
      'cliente'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'tipo_cliente'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCliente'), 'add_empty' => true)),
      'tipo_cobro'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCobro'), 'add_empty' => true)),
      'moneda'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => true)),
      'cli_gen_comis' => new sfWidgetFormInputCheckbox(),
      'monto'         => new sfWidgetFormInputText(),
      'zona_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'         => new sfValidatorDate(),
      'cliente'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'required' => false)),
      'tipo_cliente'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCliente'), 'required' => false)),
      'tipo_cobro'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCobro'), 'required' => false)),
      'moneda'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'cli_gen_comis' => new sfValidatorBoolean(array('required' => false)),
      'monto'         => new sfValidatorNumber(array('required' => false)),
      'zona_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listado_cobros[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListadoCobros';
  }

}
