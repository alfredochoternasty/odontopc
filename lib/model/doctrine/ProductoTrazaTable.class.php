<?php

/**
 * ProductoTrazaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProductoTrazaTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProductoTrazaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProductoTraza');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Cliente c');
      $q->leftJoin($rootAlias . '.Producto p');
      $q->leftJoin($rootAlias . '.Proveedor pr');
      return $q;
    }
}