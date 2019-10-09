DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select 
	detalle_resumen.id AS id,
	resumen.id AS resumen_id,
	resumen.tipofactura_id AS tipofactura_id,
	resumen.fecha AS fecha,
	resumen.cliente_id AS cliente_id,
	resumen.zona_id AS zona_id,
	detalle_resumen.producto_id AS producto_id,
	producto.grupoprod_id AS grupoprod_id,
	producto.orden_grupo AS orden_grupo,
	producto.nombre AS nombre,
	detalle_resumen.nro_lote AS nro_lote,
	detalle_resumen.cantidad AS cantidad,
	detalle_resumen.bonificados AS bonificados,
	detalle_resumen.precio AS precio,
	detalle_resumen.iva AS iva,
	detalle_resumen.sub_total AS sub_total,
	detalle_resumen.total AS total,
	detalle_resumen.det_remito_id AS det_remito_id,
	(
		select sum(dev_producto.cantidad)
		from dev_producto 
		where 
			dev_producto.producto_id = detalle_resumen.producto_id
			and dev_producto.nro_lote <> detalle_resumen.nro_lote
			and dev_producto.resumen_id = detalle_resumen.resumen_id
	) AS cant_dev 
from 
	resumen 
		left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		left join producto on detalle_resumen.producto_id = producto.id
where 
	producto.grupoprod_id not in (1,15)
	and not(detalle_resumen.nro_lote in (select lotes_romi.nro_lote from lotes_romi))
order by 
	producto.grupoprod_id,
	producto.orden_grupo,
	producto.nombre 