<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * ClienteUltimaCompra filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClienteUltimaCompraFormFilter extends BaseClienteUltimaCompraFormFilter
{
  public function configure()
  {
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));        
    $this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
    
    $this->validatorSchema['fecha'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));    
  }
}
