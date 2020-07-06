<?php

/**
 * ZonaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ZonaTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ZonaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Zona');
    }
		
		public function getZonasUsuario(){
			$zid = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
			$result = Doctrine::getTable('Zona')->find($zid);
			// ->createQuery('q')
			// ->leftJoin('q.UsuarioZona uz')
			// ->andWhere('uz.usuario = '.$id);
			// $result = $query->execute();
			return $result;
		}	
}