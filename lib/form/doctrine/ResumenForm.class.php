<?php

/**
 * Resumen form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ResumenForm extends BaseResumenForm
{
  protected $detallesABorrar = array();
  
  public function configure()
  {
    parent::configure();
    
    //unset($this['pagado'], $this['lista_id'], $this['moneda_id']);
    
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'table_method' => 'getActivos', 'method' => 'getDescAfip', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->widgetSchema['remito_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Resumen', 'table_method' => 'getRemitosVta', 'method' => 'getDescRemito', 'add_empty' => true, 'order_by' => array('fecha', 'desc')), array('style' => 'width:250px;'));
    //$this->widgetSchema['pedido_id'] = new sfWidgetFormInputHidden();    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
		
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();

    if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
      $this->widgetSchema['nro_factura'] = new sfWidgetFormInput();
      $this->widgetSchema['tipofactura_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => false));
			$this->widgetSchema['saldo_dolar'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['saldo_dolar'] =  new sfValidatorInteger();
			$this->setDefault ('saldo_dolar', 0);
    }else{
      unset($this['tipofactura_id'], $this['nro_factura']);
			$this->widgetSchema['saldo_dolar'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1; font-weight: bold; font-size:16px; color:#FF0000'));
			$this->validatorSchema['saldo_dolar'] =  new sfValidatorInteger();
    }

	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();
	
    
		$this->widgetSchema['cuit'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));		
		$this->widgetSchema['afip'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));		
		$this->widgetSchema['saldo_pesos'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1; font-weight: bold; font-size:16px; color:#FF0000'));
		
		$this->validatorSchema->setOption('allow_extra_fields', true);		    
		
		//$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getId());	sfGuardSecurityUser
		$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
  }
}