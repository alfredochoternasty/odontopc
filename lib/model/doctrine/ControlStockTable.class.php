<?php

/**
 * ControlStockTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ControlStockTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ControlStockTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('ControlStock');
    }
		
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
			
			$rootAlias = $q->getRootAlias();
			$q->leftJoin($rootAlias . '.Producto p');
			$q->leftJoin($rootAlias . '.Grupo g');
			$q->leftJoin($rootAlias . '.Zona z');
			$q->leftJoin('z.UsuarioZona uz');
			$q->andWhere('uz.usuario = '.$id);
			$q->orderBy('lower(p.nombre)');
			
			return $q;
    }		
}