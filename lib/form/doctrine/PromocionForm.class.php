<?php

/**
 * Promocion form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PromocionForm extends BasePromocionForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['fecha_ini'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_ini'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

    $this->widgetSchema['fecha_fin'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha_fin'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

    $this->widgetSchema['agregar_como'] = new sfWidgetFormChoice(array('choices' => array('1' => 'Producto Requisito', '2' => 'Producto Promocionado', '3' => 'Ambos')));
    $this->validatorSchema['agregar_como'] = new sfValidatorChoice(array('choices' => array(1,2,3)));
		
		$grupos = Doctrine::getTable('Grupoprod')->findAll();
		foreach ($grupos as $grupo) $grup[] =  $grupo->id;
    $this->widgetSchema['grupos'] = new sfWidgetFormDoctrineChoice(array('model' => 'Grupoprod', 'add_empty' => true));
    $this->validatorSchema['grupos'] = new sfValidatorChoice(array('choices' => $grup, 'multiple' => true, 'min' => 1));

		$productos = Doctrine::getTable('Producto')->findAll();
		foreach ($productos as $producto) $prods[] =  $producto->id;
    $this->widgetSchema['productos'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true, 'choices' => array('' => '')));
    $this->validatorSchema['productos'] = new sfValidatorChoice(array('choices' => $prods, 'multiple' => true, 'min' => 1));
    
    // $this->validatorSchema->setOption('allow_extra_fields', true);
  }
  
}