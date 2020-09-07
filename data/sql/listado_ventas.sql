DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select 
  detalle_resumen.id,
	resumen.id as resumen_id,
  resumen.cliente_id,
  detalle_resumen.producto_id,
	producto.grupoprod_id,
	resumen.zona_id,
	resumen.fecha,
  nro_lote,
  cantidad,
	tipofactura_id
from 
	resumen 
		left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		left join producto on producto.id = detalle_resumen.producto_id
UNION ALL
select 
	dev_producto.id,
	dev_producto.resumen_id,
	dev_producto.cliente_id,
	dev_producto.producto_id,
	producto.grupoprod_id,
	dev_producto.zona_id,
	dev_producto.fecha,
	dev_producto.nro_lote,
	dev_producto.cantidad * -1 AS cantidad,
	tipofactura_id
from 
	dev_producto
		left join producto on dev_producto.producto_id = producto.id
