<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * CursoInscripcion filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoInscripcionFormFilter extends BaseCursoInscripcionFormFilter
{
  public function configure()
  {
    parent::configure();
    
		$this->widgetSchema['curso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'table_method' => 'getCursosZona', 'method' => 'getNomCurso', 'add_empty' => true, 'order_by' => array('nombre', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['curso_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso')));
    
    $this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hasta %to_date%'));
    $this->validatorSchema['fecha'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')))); 
    
    $this->widgetSchema['asistio'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['asistio'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->widgetSchema['pago'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['pago'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    
    $this->widgetSchema['visto'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Si', 0 => 'No')));
    $this->validatorSchema['visto'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
  }
}
