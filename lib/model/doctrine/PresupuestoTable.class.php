<?php

/**
 * PresupuestoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PresupuestoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PresupuestoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Presupuesto');
    }
    
		function construct(){
        $this->setOption('orderBy','fecha desc, id desc');
    }
    
    public function retrieveConJoins(Doctrine_Query $q){
			$zid = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
      $rootAlias = $q->getRootAlias();
			$q->andWhere($rootAlias. '.zona_id = ?', $zid);
      $q->orderBy($rootAlias. '.fecha desc');
      return $q;
    }
}