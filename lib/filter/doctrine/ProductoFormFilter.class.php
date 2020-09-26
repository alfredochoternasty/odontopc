<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * Producto filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoFormFilter extends BaseProductoFormFilter
{
  public function configure()
  {
    unset($this['codigo'], $this['precio_vta'], $this['mueve_stock'], $this['stock_actual'], $this['ctr_fact_grupo']);
    
    $this->widgetSchema['activo'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['activo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true, 'order_by' => array('nombre', 'asc')));    
    
    $this->widgetSchema['genera_comision'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['genera_comision'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
  }
}
