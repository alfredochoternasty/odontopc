<?php

/**
 * DetalleResumen form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetalleResumenForm extends BaseDetalleResumenForm
{
  
  public function configure()
  {
    parent::configure();
    
    unset($this['fecha_vto'], $this['lista_id'], $this['moneda_id']);
    
    $this->widgetSchema['resumen_id'] = new sfWidgetFormInputHidden();
    		
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
		
    $this->widgetSchema['nro_lote'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->widgetSchema['cantidad'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->widgetSchema['bonificados'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    
    if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
      $this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
      $this->widgetSchema['sub_total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    }else{
      unset($this['iva'], $this['sub_total']);
    }
    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    
    
    $this->validatorSchema['cantidad'] =  new sfValidatorNumber(array('required' => true));
    $this->validatorSchema['bonificados'] =  new sfValidatorNumber(array('required' => true));
    $this->validatorSchema['nro_lote'] =  new sfValidatorString(array('required' => true));
	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();	
		
		//$this->widgetSchema['moneda'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));		
		//$this->validatorSchema->setOption('allow_extra_fields', true);		    
		
    //$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getId());	
		$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
  }
  
}
