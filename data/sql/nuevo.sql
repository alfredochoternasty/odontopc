ALTER TABLE tipo_factura
	ADD COLUMN cod_tipo_afip SMALLINT NULL;

UPDATE tipo_factura SET cod_tipo_afip='1' WHERE  id=1;
UPDATE tipo_factura SET cod_tipo_afip='6' WHERE  id=2;
UPDATE tipo_factura SET cod_tipo_afip='11' WHERE  id=3;
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE DEBITO A', '2');
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE CREDITO A', '3');
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE DEBITO B', '7');
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE CREDITO B', '8');
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE DEBITO C', '12');
INSERT INTO tipo_factura (nombre, cod_tipo_afip) VALUES ('NOTA DE CREDITO C', '13');


ALTER TABLE condicion_fiscal
	ADD COLUMN cod_tipo_afip SMALLINT NULL;	
	
UPDATE condicion_fiscal SET cod_tipo_afip='80' WHERE  id=1;
UPDATE condicion_fiscal SET cod_tipo_afip='80' WHERE  id=2;
UPDATE condicion_fiscal SET cod_tipo_afip='80' WHERE  id=3;
UPDATE condicion_fiscal SET cod_tipo_afip='96' WHERE  id=4;

ALTER TABLE dev_producto
	ADD COLUMN afip_vto_cae DATE NULL;
	
ALTER TABLE dev_producto
	ADD COLUMN pto_vta CHAR(4) NULL;

ALTER TABLE resumen
	ADD COLUMN pto_vta CHAR(4) NULL;
	
ALTER TABLE dev_producto
	ADD COLUMN tipofactura_id INT NULL;

ALTER TABLE dev_producto
	ADD COLUMN nro_factura INT NULL;	
	
ALTER TABLE detalle_presupuesto
	ADD COLUMN iva DECIMAL(10,2) NULL ;
	
ALTER TABLE banco
	ALTER nombre DROP DEFAULT;
ALTER TABLE banco
	CHANGE COLUMN nombre nombre VARCHAR(255) NOT NULL;
	
CREATE TABLE tipo_venta (
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);

ALTER TABLE resumen
	ADD COLUMN tipo_venta_id INT NOT NULL DEFAULT '1';
	
INSERT INTO ventas.tipo_venta (id, nombre) VALUES ('1', 'Cuenta Corriente');
INSERT INTO ventas.tipo_venta (id, nombre) VALUES ('2', 'Contado/Efectivo');

ALTER TABLE resumen
	ADD COLUMN remito_id INT NULL;