<?php

/**
 * CursoInscripcion form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoInscripcionForm extends BaseCursoInscripcionForm
{
  public function configure()
  {
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))); 

    $this->widgetSchema['es_cliente'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));    
    $this->widgetSchema['es_cliente'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));    
    
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));  
    
    $this->widgetSchema['asistio'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));    
    $this->widgetSchema['mas_info'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));

    $this->widgetSchema['compro'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'SI' => 'Si', 'NO' => 'No')));    
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
  }
}
