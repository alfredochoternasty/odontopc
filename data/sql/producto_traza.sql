drop view producto_traza;
create view producto_traza as
select
	floor(1+(rand()*999999999999)) as id,
	r.id as resumen_id,
	r.fecha as fecha_venta,
	r.cliente_id,	
	dr.producto_id,
	replace(dr.nro_lote,	't ',	'') as nro_lote,
	l.fecha_vto,
	sum(dr.cantidad) + sum(dr.bonificados) as vendidos,
	(select sum(dp.cantidad) from dev_producto dp where dr.resumen_id = dp.resumen_id and dr.nro_lote = dp.nro_lote) as devueltos
from 
	detalle_resumen dr
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join lote l on dr.producto_id = l.producto_id and dr.nro_lote = l.nro_lote and r.zona_id = l.zona_id
where 
	not exists(select 1 from lotes_romi where lotes_romi.nro_lote = dr.nro_lote)
	and r.zona_id = 1
	and r.tipofactura_id <> 4
group by
	r.id,
	r.fecha,
	r.cliente_id,	
	dr.producto_id,
	dr.nro_lote,
	l.fecha_vto
having 
	vendidos > devueltos 
	or devueltos is null;