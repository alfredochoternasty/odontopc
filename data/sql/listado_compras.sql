DROP VIEW listado_compras
CREATE VIEW listado_compras AS 
select
  detalle_compra.id,
  detalle_compra.compra_id,
  compra.fecha,
  compra.proveedor_id,
  detalle_compra.producto_id,
  detalle_compra.precio,
  detalle_compra.cantidad,
  detalle_compra.total,
  producto.grupoprod_id,
  detalle_compra.nro_lote,
	compra.zona_id
from
  compra
    left join detalle_compra on compra.id = detalle_compra.compra_id
    left join producto on detalle_compra.producto_id = producto.id
    LEFT JOIN lote ON detalle_compra.nro_lote = lote.nro_lote
WHERE
	lote.externo = 0
	AND lote.activo = 1
order by
  producto.grupoprod_id, producto.orden_grupo;