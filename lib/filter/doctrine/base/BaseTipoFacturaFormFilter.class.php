<?php

/**
 * TipoFactura filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoFacturaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cod_tipo_afip'   => new sfWidgetFormFilterInput(),
      'letra'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_fact_cancela' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'cod_tipo_afip'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'letra'           => new sfValidatorPass(array('required' => false)),
      'id_fact_cancela' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tipo_factura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoFactura';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'nombre'          => 'Text',
      'cod_tipo_afip'   => 'Number',
      'letra'           => 'Text',
      'id_fact_cancela' => 'Number',
    );
  }
}
