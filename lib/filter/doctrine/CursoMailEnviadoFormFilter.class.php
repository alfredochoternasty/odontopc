<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * CursoMailEnviado filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CursoMailEnviadoFormFilter extends BaseCursoMailEnviadoFormFilter
{
  public function configure()
  {
		$this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
		$this->validatorSchema['cliente_id'] = new  sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'), 'column' => 'id'));
		
    $this->widgetSchema['tipo_envio'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'A todos lo clientes', 2 => 'A un cliente', '3' => 'A un email')));
    $this->validatorSchema['tipo_envio'] = new sfValidatorInteger();

		$this->widgetSchema['usuario'] = new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'table_method' => 'getUsuariosUsuarios', 'add_empty' => true));
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();
		
		$this->widgetSchema['e_mail'] = new sfWidgetFormFilterInput();    
		$this->validatorSchema['e_mail'] =  new sfValidatorString();
		
		$this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
		$this->validatorSchema['fecha'] = new  sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));
  }
	
	public function addUsuarioColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if (!empty($values)) {
			$query->andWhere("usuario = ?", $values);
		}
	}

	public function addEMailColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if (!empty($values)) {
			$query->andWhere("e_mail = ?", $values);
		}
	}
	
	public function addClienteIdColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if (!empty($values)) {
			$query->andWhere("cliente_id = ?", $values);
		}
	}
	
	public function addTipoEnvioColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if ( in_array($values, array(0, 1)) ) {
			$query->andWhere("tipo_envio = ?", $values);
		}
	}		
}
