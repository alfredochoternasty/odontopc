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
    $this->widgetSchema['compra_id'] = new sfWidgetFormInputHidden();
    $choices = ProductoTable::getArrayActivos();
    $this->widgetSchema['producto_id'] = new sfWidgetFormChoice(array('choices' => $choices), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));        
    if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
      $this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
      $this->widgetSchema['sub_total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    }else{
      unset($this['iva'], $this['sub_total']);
    }
    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
   
    $this->validatorSchema['compra_id'] =  new sfValidatorNumber();
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
  }
}
