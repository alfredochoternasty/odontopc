<?php
 
class pedComponents extends sfComponents
{
  public function executeCantPedNuevos()
  {
    $query = Doctrine::getTable('Pedido')
			->createQuery()
			->andWhere('finalizado = 1')
			->andWhere('vendido = 0')
			->andWhere('zona_id = ?', $this->getUser()->getGuardUser()->getZonaId())
			->orderBy('fecha ASC');
 
    $pedidos_nuevos = $query->execute();
    $this->cant_pedidos_nuevos = count($pedidos_nuevos);
  }
}

?>