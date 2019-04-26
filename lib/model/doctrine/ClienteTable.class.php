<?php

/**
 * ClienteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ClienteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ClienteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Cliente');
    }

    function construct(){
        $this->setOption('orderBy','apellido, nombre');
    }
		
    public function retrieveConJoins(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Tipo t');
      $q->leftJoin($rootAlias . '.Localidad l');
			$q->leftJoin($rootAlias . '.Zona z');
			$q->leftJoin('z.UsuarioZona uz');
			$q->andWhere('uz.usuario = '.$id);	
      return $q;
    }
    
    public function retrieveConSaldos(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->addSelect('t.nombre');
      $q->addSelect($rootAlias . '.dni');
      $q->addSelect($rootAlias . '.apellido');
      $q->addSelect($rootAlias . '.nombre');
      $q->addSelect('FORMAT(sum(cta.debe - cta.haber), 2) as saldo');
      $q->addSelect('max(fecha) as fecha');
      $q->addSelect('cta.id');
      $q->addSelect('m.simbolo as simbolo');
      $q->addSelect('m.nombre as moneda');
      $q->leftJoin($rootAlias . '.Cuenta cta');
      $q->leftJoin($rootAlias . '.Tipo t');
      $q->leftJoin('cta.Moneda m');
			$q->where($rootAlias . '.activo = 1');
      $q->addGroupBy('t.nombre');
      $q->addGroupBy('m.nombre');
      $q->addGroupBy($rootAlias . '.dni');
      $q->addGroupBy($rootAlias . '.apellido');
      $q->addGroupBy($rootAlias . '.nombre');
      return $q;
    }
    
    public function retrieveConSaldosCount(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
			$q->where($rootAlias . '.activo = 1');
      return $q;
    }
    
    public function findClientexNombre($name, $limit=10){
      return Doctrine_Core::getTable('Cliente')
      ->createQuery('c')
			->select('id, concat(apellido, " ", nombre) as ayn')
      ->where("c.apellido LIKE '%$name%' and activo = 1")
      ->limit($limit)
      ->execute();
    }
	
	public function getActivos(){
		$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
		$query = Doctrine_Core::getTable('Cliente')
		->createQuery('q')
		->leftJoin('q.Zona z')
		->leftJoin('z.UsuarioZona uz')
		->where('q.activo = 1')
		->andWhere('uz.usuario = '.$id)
		->orderBy('apellido ASC, nombre ASC');
		$result = $query->execute();
		return $result;
	}	
	
	public function getClientesEnviarCurso($p_id_curso){
		$sql = "
			select email, apellido, nombre, id
			from cliente 
			where 
				recibir_curso = 1 and activo = 1
				and email is not null
				and email <> ''
				and not exists(select '' from curso_mail_enviado where cliente.id = curso_mail_enviado.cliente_id and curso_id = $p_id_curso)
			limit 20";
		$con = Doctrine_Manager::getInstance()->connection();
		$st = $con->execute($sql);
		return $st->fetchAll();
	}
	
}