<?php

/**
 * ListadoVentasTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ListadoVentasTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ListadoVentasTable
     */
    public static function getInstance()
    {
      return Doctrine_Core::getTable('ListadoVentas');
    }
		
    function construct(){
        $this->setOption('orderBy','fecha desc, resumen_id desc');
    }

		// devuelve los detalles de las ventas y ventas asociado a un remitos
		// tambien devuelve las devoluciones
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
			
			$rootAlias = $q->getRootAlias();
			$q->leftJoin($rootAlias . '.Zona z');
			$q->leftJoin('z.UsuarioZona uz');	
			$q->where('uz.usuario = '.$id);
			$q->andWhere($rootAlias . '.tipofactura_id <> 4');
			return $q;
    }
		
		// devuelve los totales de las ventas, remitos y devoluciones
    public function retrieveCtrlvta(Doctrine_Query $q){			
			$rootAlias = $q->getRootAlias();
			$q->where($rootAlias . '.zona_id = 1');
			$q->andWhere($rootAlias . '.det_remito_id is null');
			return $q;
    }
		
    // devuelve los detaller las ventas y remitos
		public function retrieveCtrlvtadet(Doctrine_Query $q){
			$rootAlias = $q->getRootAlias();
			$q->where($rootAlias . '.zona_id = 1');
			$q->andWhere($rootAlias . '.det_remito_id is null');
			$q->andWhere($rootAlias . '.tipofactura_id <> 4');
			// $q->andWhere($rootAlias . '.cantidad >= 0');
			return $q;
    }
}