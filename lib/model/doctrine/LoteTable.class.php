<?php

/**
 * LoteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LoteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LoteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Lote');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Producto p');
      $q->leftJoin($rootAlias . '.Zona z');
      $q->where($rootAlias . '.activo = 1');
      $q->andWhere($rootAlias . '.externo = 0');
      $q->orderBy('z.nombre, p.orden_grupo, p.nombre, '.$rootAlias.'.nro_lote');
      return $q;      
    }
}