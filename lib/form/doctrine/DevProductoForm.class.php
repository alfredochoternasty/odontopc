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
    //parent::configure();
    unset($this['fecha_vto']);

    $choices = ProductoTable::getArrayActivos();
		
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));

    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
    
		$this->widgetSchema['nro_lote'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    $this->widgetSchema['precio'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));

		$this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));		
		$this->validatorSchema['iva'] =  new sfValidatorString();

    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['cantidad'] = new sfWidgetFormChoice(array('choices' => array()));    
    $this->widgetSchema['resumen_id'] = new sfWidgetFormChoice(array('choices' => array()));    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();
		
    $this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();		
		$this->validatorSchema['zona_id'] =  new sfValidatorInteger();

		$this->widgetSchema['precio_unitario'] = new sfWidgetFormInput(array(), array());
		$this->widgetSchema['iva_unitario'] = new sfWidgetFormInput(array(), array());
		$this->validatorSchema->setOption('allow_extra_fields', true);

		$u_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
		$uz = Doctrine::getTable('UsuarioZona')->findByUsuario($u_id);
			
		$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
		$this->setDefault ('zona_id', $uz[0]->zona_id);
  }
	
}
