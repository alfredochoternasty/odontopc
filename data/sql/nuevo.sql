ALTER TABLE cobro	ADD COLUMN nro_recibo INT NULL AFTER usuario;

CREATE VIEW facturas_afip as
SELECT
	r.id,
	r.tipofactura_id, 
	r.pto_vta, 
	r.nro_factura,
	fecha, 
	r.cliente_id,
	r.afip_mensaje AS cae,
	SUM(dr.iva) AS iva,
	SUM(dr.sub_total) AS neto,
	SUM(dr.total) AS total
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
WHERE afip_estado = 1
GROUP BY 
	r.id,
	r.pto_vta,
	r.nro_factura,
	fecha,
	r.cliente_id,
	r.afip_mensaje;

ALTER TABLE productoCHANGE COLUMN minimo_stock minimo_stock INT NULL DEFAULT NULL AFTER mueve_stock;

INSERT INTO ventas.sf_guard_permission (id, name, description, padre) 
VALUES ('51', 'Facturas Afip', '@facturas_afip', '10');


/*
DROP TABLE 
	producto2, 
	traza2, 
	grupoprod2, 
	det_fact_compra, 
	venta, 
	detalle_venta, 
	detalle_resumen_antes_er, 
	cuenta_compras, 
	compra2,
	pago_compra.
	pago,
	lote_er;

DROP VIEW vta_fact, comp_fact, cta_cte_prov;

DELETE FROM sf_guard_user WHERE es_cliente = 1 OR id = 150;

INSERT INTO sf_guard_user(username, last_name, first_name, email_address, algorithm, salt, password)
SELECT DISTINCT 
	dni, 
	apellido, 
	nombre, 
	email, 
	'sha1', 
	'a5c4a851c035633549bd88866b4400eb', 
	'f971bc78bbc9d723c5632a43bc2a2473ff4d4a98'
FROM cliente 
WHERE trim(dni) <> '';

SELECT dni, COUNT(*) FROM cliente GROUP BY dni HAVING COUNT(*) > 1
*/