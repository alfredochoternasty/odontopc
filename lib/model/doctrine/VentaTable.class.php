<?php

/**
 * VentaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VentaTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object VentaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Venta');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Resumen res');
      $q->leftJoin($rootAlias . '.Detalle d');
      $q->leftJoin($rootAlias . '.Moneda m');
      $q->leftJoin($rootAlias . '.TipoFactura t');
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
}