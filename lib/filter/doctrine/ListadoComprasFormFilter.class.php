<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}
/**
 * ListadoCompras filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListadoComprasFormFilter extends BaseListadoComprasFormFilter
{
  public function configure()
  {
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));

    // $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')));    
    
    $this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hasta %to_date%'));
    $this->validatorSchema['fecha'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));  
    
    $this->widgetSchema['proveedor_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true, 'order_by' => array('razon_social', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));    
    $this->validatorSchema['proveedor_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proveedor'), 'column' => 'id'));  
  }
}
