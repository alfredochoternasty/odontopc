CREATE TABLE compra2 (
	id INT(11) NOT NULL AUTO_INCREMENT,
	numero VARCHAR(50) NULL DEFAULT NULL,
	proveedor_id INT(11) NULL DEFAULT NULL,
	fecha DATE NULL DEFAULT NULL,
	producto_id INT(11) NULL DEFAULT NULL,
	cantidad INT(11) NULL DEFAULT NULL,
	nro_lote VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (id)
);
	
delete from compra2 where nro_lote like 'i0%';

ALTER TABLE detalle_resumen	ADD COLUMN exportado TINYINT NULL DEFAULT '0';
ALTER TABLE detalle_compra	ADD COLUMN exportado TINYINT NULL DEFAULT '0';