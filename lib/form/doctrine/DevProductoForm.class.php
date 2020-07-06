<?php

/**
 * DevProducto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DevProductoForm extends BaseDevProductoForm
{
  public function configure()
  {
		$modulo_factura = $this->getOption('modulo_factura');
		$usuario_id = $this->getOption('usuario_id');
		$zona_id = $this->getOption('zona_id');
		$nota_manual = $this->getOption('nota_manual');
		
		$this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
		$this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
		$this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
		$this->widgetSchema['resumen_id'] = new sfWidgetFormChoice(array('choices' => array()));
	
		$this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
		$this->setDefault('zona_id', $zona_id);
		$this->setDefault('usuario_id', $usuario_id);
		
		if ($nota_manual) {
			unset($this['fecha_vto'], $this['nro_lote'], $this['precio'], $this['cantidad']);
			
			// $this->widgetSchema->setNameFormat('notacred[%s]');
			$this->widgetSchema->setIdFormat('notacred_%s');
			
			$this->widgetSchema['total'] = new sfWidgetFormInput();
			$this->widgetSchema['producto_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['tipofactura_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['iva'] = new sfWidgetFormInputHidden();

			$this->setDefault('iva', 0);
			$this->setDefault('producto_id', 1);
			$this->setDefault('tipofactura_id', 8);
		} else {
			unset($this['fecha_vto']);
			
			$this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
			$this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));
			
			$this->widgetSchema['nro_lote'] = new sfWidgetFormChoice(array('choices' => array()));
			
			$this->widgetSchema['precio'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));

			$this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));		
			$this->validatorSchema['iva'] =  new sfValidatorString();

			$this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
			$this->widgetSchema['cantidad'] = new sfWidgetFormChoice(array('choices' => array()));    
			$this->widgetSchema['observacion'] = new sfWidgetFormTextarea();

			$this->widgetSchema['precio_unitario'] = new sfWidgetFormInput(array(), array());
			$this->widgetSchema['iva_unitario'] = new sfWidgetFormInput(array(), array());
			$this->validatorSchema->setOption('allow_extra_fields', true);
		}
  }
	
}
