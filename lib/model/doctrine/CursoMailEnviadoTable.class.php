<?php

/**
 * CursoMailEnviadoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CursoMailEnviadoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CursoMailEnviadoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('CursoMailEnviado');//->orderBy('id desc');
    }
		
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Curso c');
      //$q->leftJoin($rootAlias . '.Cliente cli');
      //$q->leftJoin($rootAlias . '.sfGuardUser u');
			$q->orderBy('id desc');
      return $q;
    }		
}