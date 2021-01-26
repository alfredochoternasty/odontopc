<?php

/**
 * Pedido form.
 *
 * @package    odontopc
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PedidoForm extends BasePedidoForm
{
  public function configure()
  {
		parent::configure();
    unset(
			$this['cliente_id'], 
			$this['fecha'], 
			$this['finalizado'], 
			$this['direccion_entrega'], 
			$this['zona_id']
		);
		
		$this->widgetSchema['forma_envio'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['forma_envio'] =  new sfValidatorString();

		$this->widgetSchema['vendido'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['vendido'] =  new sfValidatorString();

		$this->widgetSchema['fecha_venta'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['fecha_venta'] =  new sfValidatorString(array('required' => false));

		$this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
		$this->validatorSchema['observacion'] =  new sfValidatorString(array('required' => true));
	}
}
