<?php

/**
 * Grupoprod filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrupoprodFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color'        => new sfWidgetFormFilterInput(),
      'foto'         => new sfWidgetFormFilterInput(),
      'foto_chica'   => new sfWidgetFormFilterInput(),
      'categoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoria'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'color'        => new sfValidatorPass(array('required' => false)),
      'foto'         => new sfValidatorPass(array('required' => false)),
      'foto_chica'   => new sfValidatorPass(array('required' => false)),
      'categoria_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categoria'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grupoprod_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupoprod';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'nombre'       => 'Text',
      'color'        => 'Text',
      'foto'         => 'Text',
      'foto_chica'   => 'Text',
      'categoria_id' => 'ForeignKey',
    );
  }
}
