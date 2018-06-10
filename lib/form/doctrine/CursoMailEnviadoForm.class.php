<?php

/**
 * CursoMailEnviado form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoMailEnviadoForm extends BaseCursoMailEnviadoForm
{
  public function configure()
  {		
		$this->widgetSchema['tipo_envio'] = new sfWidgetFormChoice(array('choices' => array('1' => 'A un mail en particular', '2' => 'A un Cliente', '3' => 'A Todos los Clientes')));		
		$this->validatorSchema['tipo_envio'] = new sfValidatorInteger();  
		
    $this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))); 
		
    $this->widgetSchema['curso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true, 'order_by' => array('id', 'desc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:500px;'));
    $this->validatorSchema['curso_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso')));		
  }
}
