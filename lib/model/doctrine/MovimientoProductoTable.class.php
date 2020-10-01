<?php

/**
 * MovimientoProductoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MovimientoProductoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object MovimientoProductoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MovimientoProducto');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
			
			$rootAlias = $q->getRootAlias();
			$q->leftJoin($rootAlias . '.Zona z');
			$q->leftJoin('z.UsuarioZona uz');	
			$q->where('uz.usuario = '.$id);
			$q->andWhere('('.$rootAlias.'.det_remito_id is null) or ('.$rootAlias.'.tipofactura_id = 4)');
			return $q;
    }
}