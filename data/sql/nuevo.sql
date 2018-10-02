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

ALTER TABLE resumen
	ADD COLUMN afip_vto_cae DATE NULL;

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
	
ALTER TABLE detalle_resumen
	ADD COLUMN cant_vend_remito SMALLINT NULL DEFAULT 0;
	
DROP VIEW control_stock;
CREATE VIEW control_stock (
 id,
 proveedor_id,
 grupoprod_id,
 grupo_nombre,
 producto_id,
 producto_nombre,
 nro_lote,
 comprados,
 vendidos,
 stock_calculado,
 stock_guardado
) AS
SELECT
   FLOOR(1+(RAND()*999999999999)),
	c.proveedor_id, 
	p.grupoprod_id,
	gp.nombre,
	p.id,
	p.nombre,
	dc.nro_lote, 
	SUM(dc.cantidad) AS cant_comprada,
	(
		SELECT SUM(dr.cantidad + dr.bonificados)
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS cant_vendida, 
	(
		SELECT (SUM(dc.cantidad) - SUM(dr.cantidad + dr.bonificados))
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS stock_calculado,
	l.stock stock_guardado
FROM
	detalle_compra dc
JOIN compra c ON dc.compra_id = c.id
JOIN producto p ON dc.producto_id = p.id
JOIN grupoprod gp ON p.grupoprod_id = gp.id
JOIN lote l ON dc.producto_id = l.producto_id and CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(l.nro_lote USING utf8) COLLATE utf8_spanish_ci
WHERE
	p.grupoprod_id NOT IN (1,15) AND p.activo = 1
GROUP BY
	p.id, p.nombre, dc.nro_lote
ORDER BY
	p.orden_grupo, p.nombre, dc.nro_lote;
	
ALTER TABLE tipo_factura
	ADD COLUMN letra VARCHAR(50) NULL AFTER;
	
update tipo_factura set letra = substr(nombre, -1, 1);
UPDATE tipo_factura SET letra='X' WHERE id=4;	