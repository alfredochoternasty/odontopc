<?php

/**
 * LoteAjuste form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LoteAjusteForm extends BaseLoteAjusteForm
{
  public function configure()
  {
    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
    
    $this->widgetSchema['nro_lote'] = new sfWidgetFormChoice(array('choices' => array()));
    $this->validatorSchema['nro_lote'] =  new sfValidatorString(array('required' => true));
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
    $this->validatorSchema['observacion'] =  new sfValidatorString(array('required' => true));
    $this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
  }
}
