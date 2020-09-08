<?php

/**
 * pedidos actions.
 *
 * @package    odontopc
 * @subpackage pedidos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pedActions extends sfActions
{
	public function executePedidos(sfWebRequest $request) {
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $id_cliente = $clientes[0]->getId();
		$this->pedidos = Doctrine_Core::getTable('Pedido')->createQuery('p')->where('finalizado = 1 and cliente_id = '.$id_cliente)->orderBy('p.id DESC')->execute();
		$this->setLayout('layout_app');
	}
	
	public function executeDetpedido(sfWebRequest $request) {
    $pid = $request->getParameter('pid');
    $this->detalle_pedido = Doctrine::getTable('DetallePedidoOriginal')->findByPedidoId($pid);
    $this->nro_pedido = $pid;
		$this->total_pedido = 0;
		foreach ($this->detalle_pedido as $det) {
			$this->total_pedido += $det->total;
		}
		$this->setLayout('layout_app');
	}

}