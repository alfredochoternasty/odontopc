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
  `porc_desc` DECIMAL(5,2) NULL,
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
  `promocion_id` INT NULL,
  `producto_id` INT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `ventas`.`promocion` 
CHANGE COLUMN `nombre` `nombre` VARCHAR(255) NOT NULL ,
CHANGE COLUMN `descripcion` `descripcion` VARCHAR(255) NULL DEFAULT NULL ;

ALTER TABLE `ventas`.`detalle_pedido` 
CHANGE COLUMN `observacion` `observacion` VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN `asignacion_lote` `asignacion_lote` VARCHAR(255) NULL DEFAULT NULL ;

INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`, `padre`)
VALUES ('275', 'Promociones', '@promocion', '230');

UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Menu' WHERE (`id` = '510');
UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Perfiles' WHERE (`id` = '500');
UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Lista de Precios' WHERE (`id` = '270');
UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Grupos' WHERE (`id` = '260');
UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Presupuestos' WHERE (`id` = '250');
UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Adm. de Productos' WHERE (`id` = '240');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '10' WHERE (`id` = '250');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '45' WHERE (`id` = '250');
UPDATE `ventas`.`sf_guard_user_permission` SET `permission_id` = '45' WHERE (`permission_id` = '250');

delete FROM sf_guard_user_permission WHERE permission_id NOT IN (SELECT id FROM sf_guard_permission);

ALTER TABLE `sf_guard_user_permission`
	ADD CONSTRAINT `permisos` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	ADD CONSTRAINT `usuarios` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON UPDATE CASCADE;

INSERT INTO `ventas`.`configuracion` (`id`, `valor`) VALUES ('enviar_cliente', 'N');
INSERT INTO `ventas`.`configuracion` (`id`, `valor`) VALUES ('enviar_cliente_url', 'http://');

ALTER TABLE `ventas`.`pedido` 
ADD COLUMN `usuario_id` INT(11) NULL AFTER `zona_id`;

ALTER TABLE `ventas`.`lote` 
ADD COLUMN `activo` INT(1) NULL DEFAULT 1 AFTER `zona_id`,
CHANGE COLUMN `producto_id` `producto_id` INT(11) NOT NULL ,
CHANGE COLUMN `nro_lote` `nro_lote` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
CHANGE COLUMN `usuario` `usuario_id` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `ventas`.`log_lote` 
CHANGE COLUMN `usuario` `usuario_id` INT(11) NULL DEFAULT NULL ;

update lote set activo = 0 where nro_lote like 'er%';
DELETE FROM `ventas`.`lote` WHERE (`id` = '243');
DELETE FROM `ventas`.`lote` WHERE (`id` = '262');

DROP TRIGGER IF EXISTS `ventas`.`ti_lote`;

DELIMITER $$
USE `ventas`$$
CREATE DEFINER=`root`@`localhost` TRIGGER `ti_lote` AFTER INSERT ON `lote` FOR EACH ROW BEGIN
					INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id)
					VALUES(NOW(), 'INSERT', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id);
				END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `ventas`.`tu_lote`;

DELIMITER $$
USE `ventas`$$
CREATE DEFINER=`root`@`localhost` TRIGGER `tu_lote` AFTER UPDATE ON `lote` FOR EACH ROW BEGIN
					INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id)
					VALUES(NOW(), 'UPDATE', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id);
				END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `ventas`.`td_lote`;

DELIMITER $$
USE `ventas`$$
CREATE DEFINER=`root`@`localhost` TRIGGER `td_lote` AFTER DELETE ON `lote` FOR EACH ROW BEGIN
					INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id)
					VALUES(NOW(), 'DELETE', OLD.id, OLD.producto_id, OLD.nro_lote, OLD.stock, OLD.fecha_vto, OLD.compra_id, OLD.observacion, OLD.usuario_id, OLD.zona_id);
				END$$
DELIMITER ;



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