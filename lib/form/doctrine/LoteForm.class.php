<?php

/**
 * Lote form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LoteForm extends BaseLoteForm
{
  public function configure()
  {
  
    $choices = ProductoTable::getArrayActivos();
    $this->widgetSchema['producto_id'] = new sfWidgetFormChoice(array('choices' => $choices), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));        
    $this->validatorSchema['producto_id'] =  new sfValidatorNumber(array('required' => true));
    
    $this->widgetSchema['nro_lote'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));    
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
  }
}
