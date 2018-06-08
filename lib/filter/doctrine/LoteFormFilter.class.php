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
    $choices = ProductoTable::getArrayActivos();
    $this->widgetSchema['producto_id'] = new sfWidgetFormChoice(array('choices' => $choices), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));        
    
    $this->widgetSchema['fecha_vto'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date%<br />hasta %to_date%'));
    $this->widgetSchema['grupo'] = new sfWidgetFormDoctrineChoice(array('model' => 'Grupoprod', 'add_empty' => true));
    $this->widgetSchema['grupo2'] = new sfWidgetFormDoctrineChoice(array('model' => 'Grupoprod', 'add_empty' => true));
    $this->widgetSchema['grupo3'] = new sfWidgetFormDoctrineChoice(array('model' => 'Grupoprod', 'add_empty' => true));

    $this->validatorSchema['fecha_vto'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));    
    $this->validatorSchema['grupo'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['grupo2'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['grupo3'] = new sfValidatorPass(array('required' => false));
  }
  
	public function addGrupoColumnQuery(Doctrine_Query $query, $field, $values)
	{
    /* esto anda pero el debajo tiene menos codigo
    $text = $value['text'];
    if($text)
      $query->leftJoin($query->getRootAlias().'.User u')->andWhere('(u.first_name LIKE ?
      OR u.last_name LIKE ?
      OR u.username LIKE ?)', array("%$text%", "%$text%", "%$text%"));
     
    return $query;
    */
		//print_r($values);
		if ($values['text'] != '') {
			//$query->andWhere('p.grupoprod_id = ?', $values['text']);
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
	
	public function getFields()
	{
	  return parent::getFields() + array('Grupo' => 'custom', 'Grupo2' => 'custom','Grupo3' => 'custom');
	}  
}
