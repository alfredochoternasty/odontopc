<?php

/**
 * CompraTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CompraTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CompraTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Compra');
    }
    
    function construct(){
        $this->setOption('orderBy','fecha DESC');
    }    
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Proveedor p');
      $q->leftJoin($rootAlias . '.Remito res');
      $q->leftJoin('res.TipoFactura t');
      $q->leftJoin($rootAlias . '.Tipofactura tf');
			$q->leftJoin($rootAlias . '.Zona z');
			$q->leftJoin('z.UsuarioZona uz');
			$q->andWhere('uz.usuario = '.$id);
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
}