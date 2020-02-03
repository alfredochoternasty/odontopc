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
    unset($this['fecha_nacimiento'], $this['usuario_id'], $this['tipo_id'], $this['fax']);
		
		$zona_id = $this->getOption('zona_id');
		
    $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'Masculino', 'F' => 'Femenino', 'J' => 'Persona Juridica')));
    $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true, 'order_by' => array('nombre', 'asc'), 'method' => 'getLocConProvincia', 'table_method' => 'retrieveConJoins'), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));    
    $this->widgetSchema['genera_comision'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    $this->widgetSchema['apellido'] = new sfWidgetFormInputText(array(), array('size' => 70));
    $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('size' => 70));
    $this->widgetSchema['domicilio'] = new sfWidgetFormInputText(array(), array('size' => 70));
    $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('size' => 40));
    $this->widgetSchema['celular'] = new sfWidgetFormInputText(array(), array('size' => 40));
    $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('size' => 70));

		if ($zona_id != 1) {
			$this->widgetSchema['lista_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['lista_id'] =  new sfValidatorInteger();
			$this->validatorSchema['zona_id'] =  new sfValidatorInteger();
			$this->setDefault('lista_id', 1);
			$this->setDefault('zona_id', $zona_id);
		} else {
			$this->widgetSchema['lista_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true));			
			$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
		}
		
    $this->validatorSchema['genera_comision'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['email'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['lista_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista')), array('required' => true));
    
    $this->setDefault('sexo', '');
  }
}
