<?php

/**
 * ClienteSeguimiento form base class.
 *
 * @method ClienteSeguimiento getObject() Returns the current form's model object
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClienteSeguimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'cliente_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'fecha'               => new sfWidgetFormDate(),
      'hora'                => new sfWidgetFormInputText(),
      'tipo_contacto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoContacto'), 'add_empty' => false)),
      'tipo_respuesta_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuesta'), 'add_empty' => false)),
      'comentario'          => new sfWidgetFormInputText(),
      'prox_contac_fecha'   => new sfWidgetFormDate(),
      'prox_contac_hora'    => new sfWidgetFormInputText(),
      'prox_contac_tiempo'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempoContac'), 'add_empty' => true)),
      'prox_contact_coment' => new sfWidgetFormInputText(),
      'usuario'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'motivo_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoMotivo'), 'add_empty' => true)),
      'realizada'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cliente_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'fecha'               => new sfValidatorDate(),
      'hora'                => new sfValidatorString(array('max_length' => 5)),
      'tipo_contacto_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoContacto'))),
      'tipo_respuesta_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuesta'))),
      'comentario'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prox_contac_fecha'   => new sfValidatorDate(array('required' => false)),
      'prox_contac_hora'    => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'prox_contac_tiempo'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempoContac'), 'required' => false)),
      'prox_contact_coment' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'usuario'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'motivo_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoMotivo'), 'required' => false)),
      'realizada'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente_seguimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClienteSeguimiento';
  }

}
