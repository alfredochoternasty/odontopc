<?php

/**
 * Cliente form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteForm extends BaseClienteForm
{
  public function configure()
  {
    parent::configure();
    
    unset($this['fecha_nacimiento'], $this['usuario_id']);

    $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'Masculino', 'F' => 'Femenino', 'J' => 'Persona Juridica')));
    $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true, 'order_by' => array('nombre', 'asc'), 'method' => 'getLocConProvincia', 'table_method' => 'retrieveConJoins'), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));    
    $this->widgetSchema['genera_comision'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    $this->widgetSchema['lista_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true));
		
    $this->validatorSchema['genera_comision'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['email'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['lista_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista')), array('required' => true));
    
    $this->setDefault('sexo', '');
  }
}
