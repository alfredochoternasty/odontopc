INSERT INTO sf_guard_permission (id, name, description, padre) 
VALUES ('1307', 'Ajustes de Stock', '@lote_ajuste', '1305');

INSERT INTO sf_guard_permission (id, name, description, padre) 
VALUES ('1052', 'Ventas por Usuario', '@resumen_usuvta', '1010');

ALTER TABLE ventas_dev.curso ADD COLUMN cupo_max INT NULL AFTER foto4;

ALTER TABLE `ventas_dev`.`curso` 
ADD COLUMN `zona_id` INT NULL AFTER `cupo_max`;
