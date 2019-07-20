<?php

/**
 * PagoComision form base class.
 *
 * @method PagoComision getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePagoComisionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha'         => new sfWidgetFormDate(),
      'revendedor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Revendedor'), 'add_empty' => false)),
      'moneda_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false)),
      'monto'         => new sfWidgetFormInputText(),
      'tipo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'banco_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true)),
      'referencia'    => new sfWidgetFormInputText(),
      'fecha_vto'     => new sfWidgetFormDate(),
      'observacion'   => new sfWidgetFormInputText(),
      'nro_recibo'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'         => new sfValidatorDate(),
      'revendedor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Revendedor'))),
      'moneda_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'required' => false)),
      'monto'         => new sfValidatorNumber(array('required' => false)),
      'tipo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'banco_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'required' => false)),
      'referencia'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'fecha_vto'     => new sfValidatorDate(array('required' => false)),
      'observacion'   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'nro_recibo'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pago_comision[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PagoComision';
  }

}
