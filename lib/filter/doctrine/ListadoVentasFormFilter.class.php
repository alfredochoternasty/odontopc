<?php
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup(){}
}
/**
 * ListadoVentas filter form.
 *
 * @package    odontopc
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListadoVentasFormFilter extends BaseListadoVentasFormFilter
{
  public function configure()
  {
	
    $this->widgetSchema['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'table_method' => 'getActivos', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:450px;'));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));		

    $this->widgetSchema['tipofactura_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'TipoFactura', 'add_empty' => true ));
    $this->validatorSchema['tipofactura_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'TipoFactura', 'column' => 'id'));		
    
		$this->widgetSchema['grupoprod_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'),'add_empty' => true, 'order_by' => array('nombre', 'asc')));    		
    $this->validatorSchema['grupoprod_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id'));		

		$this->widgetSchema['categoria_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Categoria', 'add_empty' => true, 'order_by' => array('nombre', 'asc')));    		
    $this->validatorSchema['categoria_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Categoria', 'column' => 'id'));		
    
		$this->widgetSchema['cliente_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'table_method' => 'getActivosListado', 'method' => 'getDescAfip', 'add_empty' => true, 'order_by' => array('apellido', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['cliente_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cliente'))); 
		
		$this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)), 'with_empty' => false, 'template' => 'desde %from_date% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hasta %to_date%'));
    $this->validatorSchema['fecha'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));

		$zona_id = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
		$this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => ($zona_id>1)?false:true, 'order_by' => array('nombre', 'asc')));
		$this->validatorSchema['zona_id'] = new sfValidatorPass(array('required' => ($zona_id>1)?true:false));
	
		$this->widgetSchema['nro_lote'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size' => '60px'));
		$this->validatorSchema['nro_lote'] = new sfValidatorPass(array('required' => false));

		$this->widgetSchema['nro_remito'] = new sfWidgetFormFilterInput(array('with_empty' => false));
		$this->validatorSchema['nro_remito'] = new sfValidatorPass(array('required' => false));
  }
	
	public function getFields()
	{
		return array_merge(parent::getFields(), array('categoria_id' => 'Number', 'nro_remito' => 'Number'));
	}	
	
	public function addCategoriaIdColumnQuery($query, $field, $value)
	{
		if (!empty($value) && is_numeric($value)) {
			$rootAlias = $query->getRootAlias();
			$query->leftJoin($rootAlias.'.Grupo g');
			$query->andWhere('g.categoria_id = '.$value);
		}
		return $query;
	}

	public function addNroRemitoColumnQuery($query, $field, $value)
	{
		if (!empty($value['text']) && is_numeric($value['text'])) {
			$remito = Doctrine::getTable('Resumen')->findByNroFacturaAndTipofacturaId($value['text'], 4);
			$detalle_remito = Doctrine::getTable('DetalleResumen')->findByResumenId($remito[0]->id);
			$det_ids = array();
			foreach($detalle_remito as $det) $det_ids[] = $det->id;
			$query->andWhereIn('det_remito_id', $det_ids);
		}
		return $query;
	}
}
