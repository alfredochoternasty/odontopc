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
  
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto')), array('style' => 'width:450px;', 'style' => 'font-size:16px; background-color : #d1d1d1;'));
    $this->validatorSchema['producto_id'] =  new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => true));
    
    $this->widgetSchema['nro_lote'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'font-size:16px; background-color : #d1d1d1;'));
		$this->validatorSchema['nro_lote'] =  new sfValidatorPass();
    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));    
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
	
    $this->widgetSchema['stock'] = new sfWidgetFormInput(array(), array('style' => 'font-size:16px;'));
		$this->validatorSchema['stock'] =  new sfValidatorInteger();

		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'add_empty' => false), array('style' => 'font-size:16px; background-color : #d1d1d1;'));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger(array('required' => false));
    
		$this->widgetSchema['activo'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['activo'] =  new sfValidatorInteger(array('required' => false));
		
    $this->widgetSchema['externo'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['externo'] =  new sfValidatorInteger(array('required' => false));
  }
}
