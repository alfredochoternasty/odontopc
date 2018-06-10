<?php

/**
 * DevProductoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DevProductoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DevProductoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DevProducto');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Cliente c');
      $q->leftJoin($rootAlias . '.Resumen res');
      $q->leftJoin($rootAlias . '.Producto p');
      //$q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
}