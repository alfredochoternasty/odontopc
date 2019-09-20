<?php

/**
 * Presupuesto filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePresupuestoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lista_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true)),
      'descripcion' => new sfWidgetFormFilterInput(),
      'zona_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zona'), 'add_empty' => true)),
      'email'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lista_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lista'), 'column' => 'id')),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'zona_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zona'), 'column' => 'id')),
      'email'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('presupuesto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Presupuesto';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fecha'       => 'Date',
      'lista_id'    => 'ForeignKey',
      'descripcion' => 'Text',
      'zona_id'     => 'ForeignKey',
      'email'       => 'Text',
    );
  }
}
