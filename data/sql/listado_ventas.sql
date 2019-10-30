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
	detalle_resumen.det_remito_id AS det_remito_id
from 
	resumen 
		left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		left join producto on detalle_resumen.producto_id = producto.id
where 
	producto.grupoprod_id not in (1,15)
	and not exists(select 1 from lotes_romi where lotes_romi.nro_lote = detalle_resumen.nro_lote)
	
UNION ALL

select 
	dev_producto.id AS id,
	dev_producto.resumen_id AS resumen_id,
	dev_producto.tipofactura_id AS tipofactura_id,
	dev_producto.fecha AS fecha,
	dev_producto.cliente_id AS cliente_id,
	dev_producto.zona_id AS zona_id,
	dev_producto.producto_id AS producto_id,
	producto.grupoprod_id AS grupoprod_id,
	producto.orden_grupo AS orden_grupo,
	producto.nombre AS nombre,
	dev_producto.nro_lote AS nro_lote,
	dev_producto.cantidad * -1 AS cantidad,
	0 AS bonificados,
	dev_producto.precio * -1 AS precio,
	dev_producto.iva * -1 AS iva,
	0 AS sub_total,
	dev_producto.total * -1 AS total,
	null
from 
	dev_producto
		left join producto on dev_producto.producto_id = producto.id
where 
	producto.grupoprod_id not in (1,15)
	and not exists(select 1 from lotes_romi where lotes_romi.nro_lote = dev_producto.nro_lote)