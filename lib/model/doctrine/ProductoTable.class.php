<?php

/**
 * ProductoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProductoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProductoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Producto');
    }
    
    public function retrieveProdConGrupo(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Grupo g');
      $q->where('grupoprod_id <> 1');
      $q->andWhere('grupoprod_id <> 15');
      $q->orderBy('g.nombre, orden_grupo, nombre');
      return $q;
    }
    
    public function retrieveSinInternos(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Grupo g');
      $q->leftJoin($rootAlias . '.Lote l');
      $q->where('grupoprod_id <> 1');
      $q->andWhere('grupoprod_id <> 15');
      $q->andWhere('stock < 0'); 
	  $q->andWhere('activo = 1');			
      return $q;
    }
    
    public function ProdutosSinStock(Doctrine_Query $q){
			$id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
			$zona_id = sfContext::getInstance()->getUser()->getGuardUser()->getZonaId();
			$rootAlias = $q->getRootAlias();
			$q->addSelect('r.nombre');
			$q->addSelect('r.minimo_stock');
			$q->addSelect('sum(l.stock) as stock');
			$q->leftJoin($rootAlias . '.Lote l');
			$q->where('grupoprod_id <> 1 and grupoprod_id <> 15 and activo = 1');
			$q->andWhere('l.zona_id = '.$zona_id);
			$q->andWhere('l.stock > 0');
			$q->andWhere("l.nro_lote not like 'er%'");
			$q->groupBy('r.nombre, r.minimo_stock');
			$q->having('sum(l.stock) <= r.minimo_stock');
			
      return $q;			
    }

    static public function getArrayActivos(){
    $q = Doctrine_Query::create()
      ->from('Grupoprod g')
      ->leftJoin('g.Productos p')
      ->where('grupoprod_id not in (1, 15) or p.id = 71')
      ->andWhere('p.activo = 1')
      ->orderBy('g.nombre')
      ->addOrderBy('p.orden_grupo')
      ->addOrderBy('p.nombre');
      $res = $q->fetchArray();
      
      $choices = array("" => "");
      foreach($res as $grupos){
        $prods = array();
        foreach($grupos['Productos'] as $prod){
					if (!empty($prod['codigo'])) {
						$prods[$prod['id']] = $prod['nombre'].' ('.$prod['codigo'].')';  
					} else {
						$prods[$prod['id']] = $prod['nombre'];
					}
        }
        $choices[$grupos['nombre']] = $prods; 
      }      
      return $choices;
    }


    public function getActivos($grupo=0, $debito=false){
			$query = Doctrine_Core::getTable('Producto')->createQuery('q');
			$query->select('id, nombre');
			$query->where('activo = 1');	
			
			if ($debito) {
				$query->andWhere('id = 309');
			} elseif (!empty($grupo)) {
				$query->andWhere('grupoprod_id = ?', $grupo);
				$query->orderBy('grupoprod_id');
				$query->addOrderBy('orden_grupo');
				$query->addOrderBy('nombre');	
			} else {
				$query->andWhere('grupoprod_id not in (1, 15)');
				$query->orderBy('nombre');
			}
			
			return $query->execute();
		}
		
		public function getProdDebito() {
			return $this->getActivos(true);
		}
		
    public function retrieveProdConCod(Doctrine_Query $q){
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias . '.Grupo g');
      $q->where('codigo not is nnull 1');
			$q->andWhere('activo = 1');
      $q->orderBy('orden_grupo');
      return $q;
    }
}