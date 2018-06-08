<?php

/**
 * Producto2 filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProducto2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo'       => new sfWidgetFormFilterInput(),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'grupoprod_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'codigo'       => new sfValidatorPass(array('required' => false)),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'grupoprod_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('producto2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto2';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'codigo'       => 'Text',
      'nombre'       => 'Text',
      'grupoprod_id' => 'ForeignKey',
    );
  }
}
