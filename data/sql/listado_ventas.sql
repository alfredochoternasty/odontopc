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
	resumen.tipofactura_id,
	detalle_resumen.det_remito_id,
	resumen.nro_factura,
	detalle_resumen.descuento,
	detalle_resumen.tipo_descuento
from 
	resumen 
		join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		join producto on producto.id = detalle_resumen.producto_id
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
	resumen.tipofactura_id,
	null,
	dev_producto.nro_factura,
	null,
	null
from 
	dev_producto
		join producto on dev_producto.producto_id = producto.id
		join resumen on dev_producto.resumen_id = resumen.id
where
  (dev_producto.zona_id = 1 and resumen.tipofactura_id <> 4)
  or (dev_producto.zona_id > 1);