<?php

/**
 * Producto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoForm extends BaseProductoForm
{
  public function configure()
  {
    parent::configure();
    unset($this['mueve_stock'], $this['moneda_id'], $this['genera_comision']);
        
    $this->widgetSchema['ctr_fact_grupo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['ctr_fact_grupo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => false, 'order_by' => array('nombre', 'asc')));    
    
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->validatorSchema->setOption('allow_extra_fields', true);		    
    $this->widgetSchema['precio_vta'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['iva'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly', 'style' => 'background-color : #d1d1d1;'));
    $this->widgetSchema['total'] = new sfWidgetFormInput(array(), array('style' =>'font-weight: bold; font-size:16px; color:#FF0000'));
    
  }
}
