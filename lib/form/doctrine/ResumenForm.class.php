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
    
    unset($this['pagado'], $this['lista_id'], $this['moneda_id']);
    
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));        
    $this->widgetSchema['pedido_id'] = new sfWidgetFormInputHidden();    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();    

    if(sfContext::getInstance()->getUser()->hasGroup('Blanco')){
      $this->widgetSchema['nro_factura'] = new sfWidgetFormInput();
      $this->widgetSchema['tipofactura_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoFactura'), 'add_empty' => false));
    }else{
      unset($this['tipofactura_id'], $this['nro_factura']);
    }

    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
  }
}