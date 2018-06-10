<?php

/**
 * Compra form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompraForm extends BaseCompraForm
{
  public function configure()
  {
    parent::configure();
    unset($this['pagado']);
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['proveedor_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true, 'order_by' => array('razon_social', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['proveedor_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor')));    
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
	$this->validatorSchema['usuario'] =  new sfValidatorInteger();
	
    //$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getId());	
		$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
  }
}