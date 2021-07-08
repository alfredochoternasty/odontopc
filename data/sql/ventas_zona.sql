DROP VIEW ventas_zona;
CREATE VIEW ventas_zona as
SELECT 
	dr.id,
	dr.id AS detalle_resumen_id,
	dr.resumen_id,
	r.fecha, 
	dr.producto_id, 
	p.grupoprod_id,
	dr.nro_lote,
	r.cliente_id, 
	r.zona_id,
	dzp.porc_desc AS prod_porc_desc,
	dzg.porc_desc AS grupo_porc_desc,
	dzp.precio_desc AS prod_precio_desc,
	dzg.precio_desc AS grupo_precio_desc,
	r.pagado AS cobrado,
	r.fecha_pagado as fecha_cobrado,
	r.pago_comision_id,
	case when r.pago_comision_id IS NOT NULL then 1 ELSE 0 END AS pagado
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	JOIN producto p ON dr.producto_id = p.id
	left outer JOIN descuento_zona dzp ON dr.producto_id = dzp.producto_id AND r.zona_id = dzp.zona_id
	left outer JOIN descuento_zona dzg ON p.grupoprod_id = dzg.grupoprod_id AND r.zona_id = dzg.zona_id
where
	r.tipofactura_id <> 4;