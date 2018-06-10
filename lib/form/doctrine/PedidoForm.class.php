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
    unset($this['cliente_id'], $this['fecha'], $this['fecha_venta'], $this['finalizado']);
		
		$this->widgetSchema['forma_envio'] = new sfWidgetFormChoice(array('choices' => array(1 => 'Envío a domicilio', 2 => 'Retiro en oficina')));
		$this->validatorSchema['forma_envio'] =  new sfValidatorNumber(array('required' => true));
		
		$this->widgetSchema['direccion_entrega'] = new sfWidgetFormTextarea();
		$this->validatorSchema['direccion_entrega'] =  new sfValidatorString(array('required' => false));
		
		$this->widgetSchema['observacion'] = new sfWidgetFormTextarea();
		$this->validatorSchema['observacion'] =  new sfValidatorString(array('required' => false));
  }
}
