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

    function construct(){
        $this->setOption('orderBy','fecha desc, id desc');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
			$zid = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
      $rootAlias = $q->getRootAlias();
			$q->andWhere($rootAlias . '.zona_id = '.$zid);
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
		
    public function getNotasManuales(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Cliente c');
			$q->leftJoin('c.Zona z');
			$q->leftJoin('z.UsuarioZona uz');			
			$q->andWhere('uz.usuario = '.$id);
			$q->andWhere($rootAlias . '.producto_id = 1');
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
}