<?php

/**
 * Compra form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompraForm extends BaseCompraForm
{
  public function configure()
  {
    parent::configure();
    unset($this['pagado'], $this['cuenta_id'], $this['moneda_id']);
    
		$usuario = sfContext::getInstance()->getUser()->getGuardUser()->getId();
		$uz = Doctrine_Core::getTable('UsuarioZona')->findByUsuario($usuario);
		$zona = Doctrine_Core::getTable('Zona')->find($uz[0]->zona_id);
		
		if ($zona->id != 1) {
			unset($this['numero']);
			$this->widgetSchema['remito_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Resumen', 'table_method' => 'getRemitosParaCompra', 'method' => 'getDescRemito', 'add_empty' => true, 'order_by' => array('fecha', 'desc')), array('style' => 'width:250px;'));
		} else {
			unset($this['remito_id']);
		}
		
    $this->widgetSchema['proveedor_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'table_method' => 'ProveedorZona', 'add_empty' => ($zona->id == 1), 'order_by' => array('razon_social', 'asc')), array('data-placeholder' => 'Escriba un Nombre...', 'class' => 'chzn-select', 'style' => 'width:350px;'));
    $this->validatorSchema['proveedor_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor')));    
		
		$this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));

		$this->widgetSchema['tipofactura_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipofactura'), 'table_method' => 'TipoFactCompraZona', 'add_empty' => false));
    
    $this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
	
    $this->widgetSchema['usuario'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['usuario'] =  new sfValidatorInteger();
		
    $this->widgetSchema['zona_id'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['zona_id'] =  new sfValidatorInteger();
		
		$this->setDefault ('usuario', sfContext::getInstance()->getUser()->getGuardUser()->getId());
		$this->setDefault ('zona_id', $zona->id);
  }
}
