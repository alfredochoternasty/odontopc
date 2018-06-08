<?php

/**
 * ClienteSeguimiento form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteSeguimientoForm extends BaseClienteSeguimientoForm
{
  public function configure()
  {
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

    $this->widgetSchema['prox_contac_fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['prox_contac_fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))); 

    $this->widgetSchema['comentario'] = new sfWidgetFormTextarea();
    $this->widgetSchema['prox_contact_coment'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['tipo_contacto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoContacto'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')));
    $this->validatorSchema['tipo_contacto_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoContacto'), 'required' => false)); 
    
    $this->widgetSchema['tipo_respuesta_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuesta'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')));
    $this->validatorSchema['tipo_respuesta_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoRespuesta'), 'required' => false));
    
    $this->widgetSchema['prox_contac_tiempo'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempoContac'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')));
    $this->validatorSchema['prox_contac_tiempo'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempoContac'), 'required' => false));    
    
    $this->widgetSchema['usuario'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));    
    $this->setDefault ('usuario', sfContext::getInstance()->getUser()->getName());
  }
}

