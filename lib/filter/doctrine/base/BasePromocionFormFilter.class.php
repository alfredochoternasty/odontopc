<?php

/**
 * Promocion filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePromocionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'      => new sfWidgetFormFilterInput(),
      'descripcion' => new sfWidgetFormFilterInput(),
      'estado'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_ini'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_fin'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tipo_id'     => new sfWidgetFormFilterInput(),
      'min_cant'    => new sfWidgetFormFilterInput(),
      'cant_regalo' => new sfWidgetFormFilterInput(),
      'porc_desc'   => new sfWidgetFormFilterInput(),
      'aplica_neto' => new sfWidgetFormFilterInput(),
      'lista_id'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'      => new sfValidatorPass(array('required' => false)),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'estado'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_ini'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_fin'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tipo_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_cant'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cant_regalo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'porc_desc'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aplica_neto' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lista_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('promocion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Promocion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'nombre'      => 'Text',
      'descripcion' => 'Text',
      'estado'      => 'Number',
      'fecha_ini'   => 'Date',
      'fecha_fin'   => 'Date',
      'tipo_id'     => 'Number',
      'min_cant'    => 'Number',
      'cant_regalo' => 'Number',
      'porc_desc'   => 'Number',
      'aplica_neto' => 'Number',
      'lista_id'    => 'Number',
    );
  }
}
