<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}

/**
 * Lote filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LoteFormFilter extends BaseLoteFormFilter
{
  public function configure()
  {
	parent::setup();
	
    $choices = ProductoTable::getArrayActivos();
    $this->widgetSchema['producto_id'] = new sfWidgetFormChoice(array('choices' => $choices), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));        
    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
    $this->widgetSchema['lote_nro'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size' => '60px'));

    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));
    $this->validatorSchema['fecha_vto'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));    
    $this->validatorSchema['lote_nro'] = new sfValidatorPass(array('required' => false));
		
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'add_empty' => true));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => false));			
  }
  
	public function addLoteNroColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if (!empty($values['text'])) {
			$query->andWhere("nro_lote = ?", $values['text']);
		}
	}  
	
/*	public function addProductoIdColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if (!empty($values)) {
			$query->andWhere("producto_id = ?", $values);
		}
	}  	
 
	public function addGrupoColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if ($values['text'] != '') {
			$query->andWhere('p.grupoprod_id = ?', $values);
		}    
	}  

	public function addGrupo2ColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if ($values['text'] != '') {
			$query->andWhere('p.grupo2 = ?', $values);
		}    
	}
  
	public function addGrupo3ColumnQuery(Doctrine_Query $query, $field, $values)
	{
		if ($values['text'] != '') {
			$query->andWhere('p.grupo3 = ?', $values);
		}    
	}
	*/
	public function getFields()
	{
	  return parent::getFields() + array('lote_nro' => 'custom');
	} 
	
}
