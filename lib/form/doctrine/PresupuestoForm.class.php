<?php

/**
 * Presupuesto form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PresupuestoForm extends BasePresupuestoForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['fecha'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true));
    $this->validatorSchema['fecha'] = new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea();
    $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('size' => 70));
    $this->widgetSchema['zona_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Zona', 'table_method' => 'getZonasUsuario', 'method' => 'getNomZona', 'add_empty' => false, 'order_by' => array('nombre', 'asc')));
    
    $u_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
		$uz = Doctrine::getTable('UsuarioZona')->findByUsuario($u_id);
		if ($uz[0]->zona_id != 1) {
			$this->widgetSchema['lista_id'] = new sfWidgetFormInputHidden();
			$this->validatorSchema['lista_id'] =  new sfValidatorInteger();
			$this->setDefault('lista_id', 1);
		} else {
			$this->widgetSchema['lista_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lista'), 'add_empty' => true));			
		}
  }
}
