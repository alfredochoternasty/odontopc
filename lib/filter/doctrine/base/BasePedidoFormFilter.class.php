<?php

/**
 * Pedido filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePedidoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cliente_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'observacion'          => new sfWidgetFormFilterInput(),
      'vendido'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_venta'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'direccion_entrega'    => new sfWidgetFormFilterInput(),
      'forma_envio'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'finalizado'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cliente_domicilio_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fecha'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cliente_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'observacion'          => new sfValidatorPass(array('required' => false)),
      'vendido'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_venta'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'direccion_entrega'    => new sfValidatorPass(array('required' => false)),
      'forma_envio'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'finalizado'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cliente_domicilio_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('pedido_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pedido';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'fecha'                => 'Date',
      'cliente_id'           => 'ForeignKey',
      'observacion'          => 'Text',
      'vendido'              => 'Number',
      'fecha_venta'          => 'Date',
      'direccion_entrega'    => 'Text',
      'forma_envio'          => 'Number',
      'finalizado'           => 'Number',
      'cliente_domicilio_id' => 'Number',
    );
  }
}
