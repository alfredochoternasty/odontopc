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
        $this->setOption('orderBy','fecha desc, id desc');
    }    
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
      $zonas_usuario = Doctrine::getTable('UsuarioZona')->findByUsuario($id);
      
      $rootAlias = $q->getRootAlias();
			$q->andWhere($rootAlias . '.zona_id = '.$zonas_usuario[0]->zona_id);
			$q->andWhere($rootAlias . '.proveedor_id not in (13, 6)');
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    }
}