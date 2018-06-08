<?php

/**
 * FacturaCompra form base class.
 *
 * @method FacturaCompra getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacturaCompraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'compra_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'), 'add_empty' => false)),
      'numero'         => new sfWidgetFormInputText(),
      'tipofactura_id' => new sfWidgetFormInputText(),
      'fecha'          => new sfWidgetFormDate(),
      'observacion'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'compra_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Compra'))),
      'numero'         => new sfValidatorInteger(),
      'tipofactura_id' => new sfValidatorInteger(),
      'fecha'          => new sfValidatorDate(),
      'observacion'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('factura_compra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacturaCompra';
  }

}
