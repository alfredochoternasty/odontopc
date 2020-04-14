CREATE TABLE `cliente_domicilio` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`cliente_id` INT NOT NULL,
	`direccion` VARCHAR(255) NOT NULL,
	`telefono` VARCHAR(255) NULL DEFAULT NULL,
	`correo` VARCHAR(255) NULL DEFAULT NULL,
	`observacion` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
;
ALTER TABLE `pedido`
	ADD COLUMN `cliente_domicilio_id` INT NULL AFTER `finalizado`;
ALTER TABLE `cliente_domicilio`
	ADD COLUMN `localidad_id` INT NULL AFTER `observacion`;
	
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