<?php

/**
 * PedidoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PedidoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PedidoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Pedido');
    }
    
    function get_pendientes(Doctrine_Query $q){
      $zid = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
      $rootAlias = $q->getRootAlias();
      $q->where($rootAlias . '.vendido = 0');
      $q->andWhere($rootAlias . '.finalizado = 1');
      $q->andWhere($rootAlias . '.zona_id = ?', $zid);
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }        
    
    function get_vendidos(Doctrine_Query $q){
      $zid = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
      $rootAlias = $q->getRootAlias();
      $q->where($rootAlias . '.vendido = 1');
      $q->andWhere($rootAlias . '.finalizado = 1');
      $q->andWhere($rootAlias . '.zona_id = ?', $zid);
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }       
}