<?php

/**
 * ResumenTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ResumenTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ResumenTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Resumen');
    }
    
    function construct(){
        $this->setOption('orderBy','fecha DESC');
    }    
    
    public function retrieveConJoins(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Cliente c');
      $q->leftJoin($rootAlias . '.TipoVenta tv');
      $q->leftJoin($rootAlias . '.TipoFactura tf');
      $q->orderBy($rootAlias . '.fecha desc');
      return $q;
    } 
		
		public function getRemitosVta(){
			$query = Doctrine_Core::getTable('Resumen')
			->createQuery('q')
			->where('q.tipofactura_id = 4')
			->andWhere('not exists(select id from resumen where resumen.remito_id = r.id)')
			->orderBy('fecha desc, nro_factura desc');
			$result = $query->execute();
			return $result;
		}
}
