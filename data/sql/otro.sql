CREATE TABLE `pedido` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`fecha` DATE NOT NULL,
	`cliente_id` INT(11) NOT NULL,
	`observacion` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`vendido` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `cliente_id_idx` (`cliente_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=MyISAM;

CREATE TABLE `detalle_pedido` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`pedido_id` INT(11) NOT NULL,
	`producto_id` INT(11) NOT NULL,
	`precio` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
	`cantidad` TINYINT(4) NOT NULL DEFAULT '1',
	`total` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
	`observacion` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`),
	INDEX `pedido_id_idx` (`pedido_id`),
	INDEX `producto_id_idx` (`producto_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=MyISAM; 

ALTER TABLE `resumen`
	ADD COLUMN `pedido_id` INT(10) NULL AFTER `pagado`;
ALTER TABLE `cliente`
	ADD COLUMN `usuario_id` INT NULL DEFAULT NULL AFTER `observacion`;
ALTER TABLE `pedido`
	ADD COLUMN `fecha_venta` DATE NULL AFTER `vendido`;
  
INSERT INTO `sf_guard_group` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES (4, 'Cliente', 'Cliente para hacer pedidos', '2013-05-28 17:40:43', '2013-05-28 17:40:44');
INSERT INTO `sf_guard_permission` (`id`, `name`, `created_at`, `updated_at`) VALUES (4, 'cliente', '2013-05-28 17:41:30', '2013-05-28 17:41:30');

