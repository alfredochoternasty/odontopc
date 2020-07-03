DROP VIEW facturas_afip;
CREATE VIEW facturas_afip as
SELECT
	r.id,
	r.tipofactura_id, 
	r.pto_vta, 
	r.nro_factura,
	fecha, 
	r.cliente_id,
	r.afip_cae AS cae,
	SUM(dr.iva) AS iva,
	SUM(dr.sub_total) AS neto,
	SUM(dr.total) AS total,
	concat(c.apellido, ' ', c.nombre) as cliente,
	c.zona_id
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	join cliente c ON r.cliente_id = c.id
WHERE afip_estado > 0
GROUP BY 
	r.id,
	r.pto_vta,
	r.nro_factura,
	fecha,
	r.cliente_id
UNION
SELECT
	d.id,
	d.tipofactura_id, 
	d.pto_vta, 
	d.nro_factura,
	fecha, 
	d.cliente_id,
	d.afip_cae AS cae,
	(d.iva * -1) as iva,
	(d.precio * d.cantidad) -1 AS neto,
	(d.total * -1) as total,
	concat(c.apellido, ' ', c.nombre) as cliente,
	c.zona_id
FROM dev_producto d
	join cliente c ON d.cliente_id = c.id
WHERE afip_estado > 0