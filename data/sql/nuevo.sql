delete from sf_guard_group_permission;

ALTER TABLE `ventas`.`sf_guard_group_permission` 
ADD CONSTRAINT `fk_group_permission_permision`
  FOREIGN KEY (`permission_id`)
  REFERENCES `ventas`.`sf_guard_permission` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_group_permission_group`
  FOREIGN KEY (`group_id`)
  REFERENCES `ventas`.`sf_guard_group` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

update sf_guard_permission set id = id+1000;
update sf_guard_permission set padre = padre+1000;

INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('100', 'Stock Minimo', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('110', 'Nuevos Pedidos', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('120', 'Ventas Actuales', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('130', 'Cantidad Clientes', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('140', 'Clientes Nuevos', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`) VALUES ('150', 'Ventas por Pedido', 'Panel Inicio');
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`, `padre`) VALUES ('50', 'Paneles Inicio', 'Paneles Inicio', '0');

UPDATE `ventas`.`sf_guard_permission` SET `padre` = '0' WHERE (`id` = '50');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '100');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '110');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '120');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '130');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '140');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '50' WHERE (`id` = '150');

UPDATE `ventas`.`sf_guard_permission` SET `padre` = '1170' WHERE (`id` = '1081');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '1170' WHERE (`id` = '1082');
UPDATE `ventas`.`sf_guard_permission` SET `padre` = '1170' WHERE (`id` = '1083');

UPDATE `ventas`.`sf_guard_permission` SET `id` = '1224' WHERE (`id` = '1081');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '1225' WHERE (`id` = '1082');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '1226' WHERE (`id` = '1083');

UPDATE `ventas`.`sf_guard_permission` SET `name` = 'Compras', `description` = '@Compras Menu' WHERE (`id` = '1170');
