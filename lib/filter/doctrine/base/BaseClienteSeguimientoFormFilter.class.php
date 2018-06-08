<?php

/**
 * ClienteSeguimiento filter form base class.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClienteSeguimientoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cliente_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true)),
      'fecha'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_contacto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoContacto'), 'add_empty' => true)),
      'tipo_respuesta_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuesta'), 'add_empty' => true)),
      'comentario'          => new sfWidgetFormFilterInput(),
      'prox_contac_fecha'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'prox_contac_hora'    => new sfWidgetFormFilterInput(),
      'prox_contac_tiempo'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempoContac'), 'add_empty' => true)),
      'prox_contact_coment' => new sfWidgetFormFilterInput(),
      'usuario'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cliente_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id')),
      'fecha'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora'                => new sfValidatorPass(array('required' => false)),
      'tipo_contacto_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoContacto'), 'column' => 'id')),
      'tipo_respuesta_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoRespuesta'), 'column' => 'id')),
      'comentario'          => new sfValidatorPass(array('required' => false)),
      'prox_contac_fecha'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'prox_contac_hora'    => new sfValidatorPass(array('required' => false)),
      'prox_contac_tiempo'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoTiempoContac'), 'column' => 'id')),
      'prox_contact_coment' => new sfValidatorPass(array('required' => false)),
      'usuario'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_seguimiento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteSeguimiento';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'cliente_id'          => 'ForeignKey',
      'fecha'               => 'Date',
      'hora'                => 'Text',
      'tipo_contacto_id'    => 'ForeignKey',
      'tipo_respuesta_id'   => 'ForeignKey',
      'comentario'          => 'Text',
      'prox_contac_fecha'   => 'Date',
      'prox_contac_hora'    => 'Text',
      'prox_contac_tiempo'  => 'ForeignKey',
      'prox_contact_coment' => 'Text',
      'usuario'             => 'Text',
    );
  }
}
