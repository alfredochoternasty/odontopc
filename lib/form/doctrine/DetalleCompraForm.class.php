<?php

/**
 * DetalleCompra form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetalleCompraForm extends BaseDetalleCompraForm
{
  public function configure()
  {
    parent::configure();
		unset($this['precio'], $this['total'], $this['iva'], $this['sub_total'], $this['usuario']);
		
    $this->widgetSchema['compra_id'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));
		
		$this->widgetSchema['trazable'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
		$this->validatorSchema['trazable'] = new sfValidatorChoice(array('required' => true, 'choices' => array(1, 0)));    			
		$this->setDefault ('trazable', 1);
		
		$this->widgetSchema['nro_lote'] = new sfWidgetFormInput(array(), array('style' => 'font-weight: bold; font-size:16px;', 'size' => 70));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
   
    $this->validatorSchema['compra_id'] =  new sfValidatorNumber();
    $this->validatorSchema['nro_lote'] =  new sfValidatorString();
		
		$this->widgetSchema['tiene_vto'] = new sfWidgetFormChoice(array('choices' => array(1 => 'Si', 0 => 'No')));
		$this->validatorSchema['tiene_vto'] = new sfValidatorChoice(array('required' => true, 'choices' => array(1, 0))); 

    $this->widgetSchema['fecha_vto'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false));    
  }
}
