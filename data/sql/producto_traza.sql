#DROP VIEW producto_traza;
#CREATE VIEW producto_traza AS
select distinct 
	dr.id AS id,
	p.id AS producto_id,
	p.codigo AS codigo,
	replace(dc.nro_lote,	'T ',	'') AS nro_lote,
	coalesce(dc.fecha_vto,	'no tiene') AS fecha_vto,
	r.id AS resumen_id,
	r.fecha AS fecha_venta,
	c.id AS cliente_id,
	c.apellido AS apellido,
	c.nombre AS nombre,
	com.fecha AS fecha_compra,
	prov.id AS proveedor_id,
	com.id AS compra_id,
	(dr.cantidad + dr.bonificados) as vendidos,
	0
from 
	producto p 
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join detalle_compra dc on dr.producto_id = dc.producto_id and dr.nro_lote = dc.nro_lote
		join compra com on dc.compra_id = com.id and r.zona_id = com.zona_id
		join proveedor prov on com.proveedor_id = prov.id
where 
	dc.trazable = 1
	and not exists(select 1 from lotes_romi where lotes_romi.nro_lote in (dr.nro_lote, dc.nro_lote))
	and com.proveedor_id <> 13
	and not exists (
		select 1
		from dev_producto dp 
		where 
			dr.resumen_id = dp.resumen_id 
			and dr.producto_id = dp.producto_id 
			and dr.nro_lote = dp.nro_lote
		
	)