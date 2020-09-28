<?php

/**
 * Categoria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Categoria extends BaseCategoria
{
	public function __toString()
	{
		$val = $this->getNombre();
		return empty($val)? '' : $val;
	}
	
	private function ejecutarSQL($p_sql) {
			$conexion = Doctrine_Manager::connection();
			$sentencia = $conexion->execute($p_sql);
			$sentencia->execute();
			return $sentencia->fetch(PDO::FETCH_OBJ);
	}

	public function getCantVendida($p_zona=0) {
		$sql = "
			select 
				sum(dr.cantidad) as cantidad
			from 
				resumen r
					join detalle_resumen dr on r.id = dr.resumen_id
					join producto p on dr.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and r.fecha >= date_format(curdate(), '%Y-%m-01')
				and ($p_zona = 0 or r.zona_id = $p_zona)
		";
		$vendidos = $this->ejecutarSQL($sql);
		
		$sql = "
			select coalesce(sum(dp.cantidad), 0) as cantidad
			from 
				dev_producto dp
					join producto p on dp.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
					join resumen r on dp.resumen_id = r.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and dp.fecha >= date_format(curdate(), '%Y-%m-01')
				and ($p_zona = 0 or dp.zona_id = $p_zona)
		";
		$devueltos = $this->ejecutarSQL($sql);		
		return $vendidos->cantidad - $devueltos->cantidad;
	}

	public function getCantVendidaAnt($p_zona=0) {
		$sql = "
			select 
				sum(dr.cantidad) as cantidad
			from 
				resumen r
					join detalle_resumen dr on r.id = dr.resumen_id
					join producto p on dr.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and r.fecha between date_format(date_sub(curdate(), interval 1 month), '%Y-%m-01') and date_sub(curdate(), interval 1 month)
				and ($p_zona = 0 or r.zona_id = $p_zona)
		";
		$vendidos = $this->ejecutarSQL($sql);
		
		$sql = "
			select coalesce(sum(dp.cantidad), 0) as cantidad
			from 
				dev_producto dp
					join producto p on dp.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
					join resumen r on dp.resumen_id = r.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and dp.fecha between date_format(date_sub(curdate(), interval 1 month), '%Y-%m-01') and date_sub(curdate(), interval 1 month)
				and ($p_zona = 0 or dp.zona_id = $p_zona)
		";
		$devueltos = $this->ejecutarSQL($sql);		
		return $vendidos->cantidad - $devueltos->cantidad;
	}
	
	public function getCantVendidaHist($p_zona=0) {
		$sql = "
			select
				year(r.fecha) as anio,
				month(r.fecha) as mes,
				sum(dr.cantidad) as cantidad
			from 
				resumen r
					join detalle_resumen dr on r.id = dr.resumen_id
					join producto p on dr.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and r.fecha between date_format(date_sub(curdate(), interval 13 month), '%Y-%m-01') and last_day(date_sub(curdate(), interval 1 month))
				and ($p_zona = 0 or r.zona_id = $p_zona)
			group by
				anio, mes
			order by
				anio asc, mes asc
		";
		$conexion = Doctrine_Manager::connection();
		$ventas =  $conexion->execute($sql);
		
		$sql = "
			select 
				year(dp.fecha) as anio,
				month(dp.fecha) as mes,
				coalesce(sum(dp.cantidad), 0) as cantidad
			from 
				dev_producto dp
					join producto p on dp.producto_id = p.id
					join grupoprod g on p.grupoprod_id = g.id
					join resumen r on dp.resumen_id = r.id
			where 
				g.categoria_id = ".$this->id."
				and r.tipofactura_id <> 4
				and dp.fecha between date_format(date_sub(curdate(), interval 13 month), '%Y-%m-01') and last_day(date_sub(curdate(), interval 1 month))
			group by
				anio, mes
			order by
				anio asc, mes asc
		";
		$conexion = Doctrine_Manager::connection();
		$devueltos =  $conexion->execute($sql);
		
		$devoluciones = array();
		foreach ($devueltos as $dev) $devoluciones[] = $dev;
		
		$vendidos = array();
		foreach ($ventas as $vta) {
			foreach ($devoluciones as $dev) {
				if ($vta['anio'] == $dev['anio'] && $vta['mes'] == $dev['mes']) {
					$vendidos[$vta['anio'].$vta['mes']]['cantidad'] = $vta['cantidad'];// - $dev['cantidad'];
				}
			}
		}
		
		return $vendidos;
	}
	
}