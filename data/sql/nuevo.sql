ALTER TABLE `sf_guard_user`
	ADD COLUMN `zona_id` SMALLINT NULL DEFAULT NULL AFTER `es_cliente`;
	
INSERT INTO `ventas`.`configuracion` (`id`, `valor`) VALUES ('mail_from', 'alfredochoternasty@gmail.com');
INSERT INTO `ventas`.`configuracion` (`id`, `valor`) VALUES ('mail_from_nombre', 'NTI Implantes');
	
ALTER TABLE `ventas`.`grupoprod` 
ADD COLUMN `foto` VARCHAR(255) NULL DEFAULT NULL AFTER `color`;
ALTER TABLE `ventas`.`grupoprod` 
ADD COLUMN `foto_chica` VARCHAR(255) NULL DEFAULT NULL AFTER `foto`;
ALTER TABLE `ventas`.`pedido` 
ADD COLUMN `zona_id` INT NULL AFTER `cliente_domicilio_id`;
INSERT INTO `ventas`.`configuracion` (`id`, `valor`) VALUES ('mostrar_cabecera', 'S');
ALTER TABLE `detalle_pedido`
	CHANGE COLUMN `cantidad` `cantidad` SMALLINT NOT NULL DEFAULT 1 AFTER `precio`;
ALTER TABLE `presupuesto`
	ADD COLUMN `telefono` VARCHAR(50) NULL DEFAULT NULL AFTER `email`;

CREATE TABLE `ventas`.`promocion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  `fecha_ini` DATE NOT NULL,
  `fecha_fin` DATE NULL,
  `tipo_id` TINYINT(1) NULL DEFAULT 1,
  `min_cant` SMALLINT(1) NULL DEFAULT 1,
  `cant_regalo` SMALLINT(1) NULL,
  `porc_desc` DECIMAL(3,2) NULL,
  `aplica_neto` TINYINT(1) NULL DEFAULT 0,
  `lista_id` INT NULL,
  PRIMARY KEY (`id`));
	
CREATE TABLE `ventas`.`promocion_producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `promocion_id` INT NULL,
  `producto_id` INT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ventas`.`promocion_regalo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `promcion_id` INT NULL,
  `prodcuto_id` INT NULL,
  PRIMARY KEY (`id`));



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