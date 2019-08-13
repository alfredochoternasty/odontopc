<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}
/**
 * ControlStock filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ControlStockFormFilter extends BaseControlStockFormFilter
{
	
  public function configure()
  {
		
    parent::configure();
    
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));		

		$this->widgetSchema['nro_lote'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size' => '60px'));
		$this->validatorSchema['nro_lote'] = new sfValidatorPass(array('required' => false));
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'add_empty' => false));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => true));

    $this->widgetSchema['ult_venta'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
    $this->validatorSchema['ult_venta'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));  
  }
	
}
