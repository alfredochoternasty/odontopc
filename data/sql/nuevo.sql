DROP VIEW listado_cobros;
CREATE VIEW listado_cobros (
  id,fecha,cliente,tipo_cliente,tipo_cobro,moneda,cli_gen_comis,monto, zona_id
) AS 
SELECT 
  cobro.id, 
  cobro.fecha, 
  cobro.cliente_id, 
  cliente.tipo_id, 
  cobro.tipo_id, 
  cobro.moneda_id, 
  cliente.genera_comision, 
  cobro.monto,
	cobro.zona_id
FROM cobro
	JOIN cliente ON cobro.cliente_id = cliente.id
	left outer join resumen r ON cobro.resumen_id = r.id
WHERE r.tipofactura_id <> 4 or cobro.resumen_id = 0;

ALTER TABLE `cobro`
	ADD COLUMN `archivo` VARCHAR(255) NULL DEFAULT NULL AFTER `zona_id`;

ALTER TABLE `tipo_factura`
	ADD COLUMN `cond_fiscales` VARCHAR(50) NULL DEFAULT NULL AFTER `modelo_impresion`;

INSERT INTO `ventas`.`producto` (`id`, `nombre`, `grupoprod_id`, `precio_vta`, `moneda_id`, `orden_grupo`, `activo`)
VALUES ('309', 'Debito - Ajuste Cta Cte', '1', '10', '0', '0', '1');

ALTER TABLE `dev_producto`
	ADD COLUMN `pago_comision_id` INT NULL AFTER `zona_id`;
	
ALTER TABLE `producto`
	ADD COLUMN `foto` VARCHAR(255) NULL DEFAULT NULL AFTER `nombre_corto`,
	ADD COLUMN `descripcion` TEXT NULL DEFAULT NULL AFTER `foto`;
ALTER TABLE `producto`
	ADD COLUMN `foto_chica` VARCHAR(255) NULL DEFAULT NULL AFTER `descripcion`;

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