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
    unset($this['cliente_id'], $this['fecha'], $this['fecha_venta']);
  }
}
