<?php

/**
 * Cobro form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CobroForm extends BaseCobroForm
{
  public function configure()
  {    
    parent::Configure();
    
    unset($this['devprod_id'], $this['resumen_id']);
    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));    
        
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente')));    
    
    $this->widgetSchema['banco_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['banco_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banco'), 'required' => false));    
    
    $this->widgetSchema['moneda_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moneda'), 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
    $this->validatorSchema['moneda_id'] = new sfValidatorInteger(array('required' => true));

    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
  }
}
