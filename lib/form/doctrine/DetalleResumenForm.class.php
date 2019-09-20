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
    //parent::configure();
    
    unset($this['fecha_vto'], $this['lista_id'], $this['moneda_id'], $this['bonificados']);
		
		$tipofactura = sfContext::getInstance()->getUser()->getAttribute('tipofactura');
    
    $this->widgetSchema['resumen_id'] = new sfWidgetFormInputHidden();
    		
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
	
    $this->widgetSchema['nro_lote'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->widgetSchema['cantidad'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->widgetSchema['descuento'] = new sfWidgetFormChoice(array('choices' => array(
			0 => 'Sin Descuento',
			5 => '5% de descuento',
			10 => '10% de descuento',
			15 => '15% de descuento',
			20 => '20% de descuento',
			25 => '25% de descuento',
			30 => '30% de descuento',
			35 => '35% de descuento',
			40 => '40% de descuento',
			45 => '45% de descuento',
			50 => '50% de descuento',
			55 => '55% de descuento',
			60 => '60% de descuento',
			65 => '65% de descuento',
			70 => '70% de descuento',
			75 => '75% de descuento',
			80 => '80% de descuento',
			85 => '85% de descuento',
			90 => '90% de descuento',
			95 => '95% de descuento',
			100 => '100% de descuento'
		)));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
		
    $this->validatorSchema['cantidad'] =  new sfValidatorNumber(array('required' => true));
    $this->validatorSchema['nro_lote'] =  new sfValidatorString(array('required' => true));
    
		if ($tipofactura != 4) {

			$this->widgetSchema['det_remito_id'] = new sfWidgetFormChoice(array('choices' => array()));
			$this->validatorSchema['det_remito_id'] = new sfValidatorNumber(array('required' => false));
			
			if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
				$u_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
				$uz = Doctrine::getTable('UsuarioZona')->findByUsuario($u_id);
				if ($uz[0]->zona_id != 1) {
					$this->widgetSchema['precio'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
				}
				$this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
				$this->widgetSchema['sub_total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
			}else{
				unset($this['iva'], $this['sub_total']);
			}
			$this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
		} else {
			if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
				$this->setDefault('iva', '0');
				$this->setDefault('sub_total', '0');
				$this->setDefault('total', '0');
				$this->setDefault('precio', '0');
				unset($this['iva'], $this['sub_total'], $this['total'], $this['precio'], $this['bonificados'], $this['det_remito_id']);
			}
		}
    

	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();	
				
		$this->setDefault('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
  }
  
}
