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
		unset($this['sexo'], $this['usuario_id']);
		
		$zona_id = !empty(sfContext::getInstance()->getUser()->getGuardUser())? sfContext::getInstance()->getUser()->getGuardUser()->getZonaId():0;
		
    $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true, 'order_by' => array('nombre', 'asc'), 'method' => 'getLocConProvincia', 'table_method' => 'retrieveConJoins'), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));    
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    $this->widgetSchema['dni'] = new sfWidgetFormInputNumber(array(), array('size' => 30));
    $this->widgetSchema['cuit'] = new sfWidgetFormInputNumber(array(), array('size' => 30));
    $this->widgetSchema['apellido'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['domicilio'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['celular'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['email_2'] = new sfWidgetFormInputText(array(), array('size' => 30));
    $this->widgetSchema['nro_matricula'] = new sfWidgetFormInputText(array(), array('size' => 30));

		
		if ($zona_id != 1) {
			$this->widgetSchema['lista_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['lista_id'] =  new sfValidatorInteger();
			$this->validatorSchema['zona_id'] =  new sfValidatorInteger();
			$this->setDefault('lista_id', 1);
			$this->setDefault('zona_id', !empty($zona_id)?$zona_id:1);
		} else {
			$this->widgetSchema['lista_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true));			
		}

    $this->validatorSchema['dni'] = new sfValidatorNumber(array('required' => true));
    $this->validatorSchema['cuit'] = new sfValidatorCUIT(array('required' => true));
    $this->validatorSchema['nro_matricula'] = new sfValidatorString(array('required' => $zona_id?false:true));
    $this->validatorSchema['celular'] = new sfValidatorNumber(array('required' => false));
    $this->validatorSchema['apellido'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['condicionfiscal_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Condfiscal'), 'required' => $zona_id?true:false));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => $zona_id?true:false, 'choices' => array('', 1, 0)));    
    $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => $zona_id?false:true));
    $this->validatorSchema['email_2'] = new sfValidatorEmail(array('required' => $zona_id?false:true));
    $this->validatorSchema['lista_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lista')), array('required' => true));

		if (!empty($zona_id)) {
			$validadores = array(new sfValidatorDoctrineUnique(array('model' => 'Cliente', 'column' => array('dni', 'cuit', 'zona_id'))));
			$error_validador = array('invalid' => 'Ya existe un cliente con el dni y/o cuit ingresados en la su zona');
		} else {
			$validadores = array(new sfValidatorDoctrineUnique(array('model' => 'Cliente', 'column' => array('dni'))));
			// $error_validador = array('invalid' => 'El DNI ingresado ya existe! si usted es cliente puede intentar recuperar su usuario y clave');
			$validadores[] = new sfValidatorSchemaCompare('email', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'email_2', array(), array('invalid' => 'El email y su confirmación no coinciden'));  
		}
    $this->validatorSchema->setPostValidator(new sfValidatorAnd($validadores), array());
		
		$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}
