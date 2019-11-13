DROP VIEW producto_traza;
CREATE VIEW producto_traza AS
select
	FLOOR(1+(RAND()*999999999999)) AS id,
	r.id AS resumen_id,
	r.fecha AS fecha_venta,
	r.cliente_id,	
	dr.producto_id,
	replace(dr.nro_lote,	'T ',	'') AS nro_lote,
	l.fecha_vto,
	sum(dr.cantidad) + sum(dr.bonificados) as vendidos,
	(select sum(dp.cantidad) from dev_producto dp where dr.resumen_id = dp.resumen_id and dr.nro_lote = dp.nro_lote) AS devueltos
from 
	detalle_resumen dr
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join lote l on dr.producto_id = l.producto_id and dr.nro_lote = l.nro_lote and r.zona_id = l.zona_id
where 
	not exists(select 1 from lotes_romi where CONVERT(lotes_romi.nro_lote using utf8) collate utf8_spanish_ci = dr.nro_lote)
	and dr.nro_lote not like 'er%'
	and r.zona_id = 1
	and r.tipofactura_id <> 4
group by
	r.id,
	r.fecha,
	r.cliente_id,	
	dr.producto_id,
	dr.nro_lote,
	l.fecha_vto
HAVING 
	vendidos > devueltos 
	or devueltos is null;