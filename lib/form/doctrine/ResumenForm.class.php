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
		$modulo_factura = $this->getOption('modulo_factura');
		$zona_id = $this->getOption('zona_id');
		$usuario_id = $this->getOption('usuario_id');
		
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'table_method' => 'getActivosVta', 'method' => 'getDescAfip', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
		
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
			
    if($modulo_factura == 'S'){
			if ($zona_id != 1) {
				$this->widgetSchema['nro_factura'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['pto_vta'] = new sfWidgetFormInputHidden();
			} else {
				$this->widgetSchema['nro_factura'] = new sfWidgetFormInput();
				$this->widgetSchema['pto_vta'] = new sfWidgetFormChoice(array('choices' => array('', '4', '5')));
			}
			$this->widgetSchema['cuit'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
			$this->widgetSchema['afip'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));			      
			$this->widgetSchema['tipofactura_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => false));
			
			$this->widgetSchema['saldo_dolar'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['saldo_dolar'] =  new sfValidatorNumber(array('required' => false));
			$this->setDefault ('saldo_dolar', 0);
    }else{
      unset($this['nro_factura'], $this['pto_vta']);
			$this->widgetSchema['saldo_dolar'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1; font-weight: bold; font-size:16px; color:#FF0000'));
			$this->validatorSchema['saldo_dolar'] =  new sfValidatorNumber(array('required' => false));
			$this->widgetSchema['cuit'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['afip'] = new sfWidgetFormInputHidden();
    }

	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger(array('required' => false));
		$this->validatorSchema['zona_id'] =  new sfValidatorInteger(array('required' => false));
	
		$this->widgetSchema['saldo_pesos'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1; font-weight: bold; font-size:16px; color:#FF0000'));
		
		$this->validatorSchema->setOption('allow_extra_fields', true);		    
		
		$this->setDefault ('usuario', $usuario_id);
		$this->setDefault ('zona_id', $zona_id);
  }
}