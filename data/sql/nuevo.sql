DROP VIEW ventas_zona;
CREATE VIEW ventas_zona as
SELECT 
	dr.id,
	dr.id AS detalle_resumen_id,
	dr.resumen_id,
	r.fecha, 
	dr.producto_id, 
	r.cliente_id, 
	c.zona_id,
	dzp.porc_desc AS prod_porc_desc,
	dzg.porc_desc AS grupo_porc_desc,
	dzp.precio_desc AS prod_precio_desc,
	dzg.precio_desc AS grupo_precio_desc,
	r.pagado
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	JOIN cliente c ON r.cliente_id = c.id
	JOIN producto p ON dr.producto_id = p.id
	left outer JOIN descuento_zona dzp ON dr.producto_id = dzp.producto_id AND c.zona_id = dzp.zona_id
	left outer JOIN descuento_zona dzg ON p.grupoprod_id = dzg.grupoprod_id AND c.zona_id = dzg.zona_id
where
	r.tipofactura_id <> 4
;

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
WHERE afip_estado = 1
GROUP BY 
	r.id,
	r.pto_vta,
	r.nro_factura,
	fecha,
	r.cliente_id,
	r.afip_mensaje;

ALTER TABLE resumen
	ADD COLUMN pago_comision_id INT NULL AFTER afip_mensaje;
	
	
CREATE TABLE `pago_comision` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`fecha` DATE NOT NULL,
	`cliente_id` INT(11) NOT NULL,
	`moneda_id` INT(11) NOT NULL DEFAULT '1',
	`monto` DECIMAL(10,2) NOT NULL DEFAULT '1.00',
	`tipo_id` INT(11) NOT NULL,
	`banco_id` INT(11) NULL DEFAULT NULL,
	`numero` INT(11) NULL DEFAULT NULL,
	`fecha_vto` DATE NULL DEFAULT NULL,
	`observacion` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`nro_recibo` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `cliente_id_idx` (`cliente_id`),
	INDEX `tipo_id_idx` (`tipo_id`),
	INDEX `moneda_id_idx` (`moneda_id`),
	INDEX `banco_id_idx` (`banco_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

	

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