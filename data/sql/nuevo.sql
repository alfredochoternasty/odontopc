DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	c.id as id, 
	c.apellido, 
	c.nombre, 
	cta.moneda_id, 
	SUM(cta.debe - cta.haber) AS saldo
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
WHERE 
	c.activo = 1
GROUP BY 
	c.id, cta.moneda_id
ORDER BY 
	c.apellido, c.nombre;

CREATE TABLE zona (
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
)
COLLATE='latin1_swedish_ci'
;

CREATE TABLE usuario_zona (
	id INT NOT NULL AUTO_INCREMENT,
	zona_id INT NOT NULL,
	usuario INT NOT NULL,
	PRIMARY KEY (id)
)
COLLATE='latin1_swedish_ci'
;

INSERT INTO zona (id, nombre) VALUES (1, 'Casa Central');
INSERT INTO zona (id, nombre) VALUES (2, 'Zona Sur');

ALTER TABLE cliente	ADD COLUMN zona_id TINYINT(4) NOT NULL DEFAULT '1' AFTER recibir_curso;
ALTER TABLE log_cliente	ADD COLUMN zona_id TINYINT(4) NOT NULL DEFAULT '1' AFTER recibir_curso;

DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	c.id as id, 
	c.apellido, 
	c.nombre, 
	cta.moneda_id, 
	SUM(cta.debe - cta.haber) AS saldo,
	zona_id
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
WHERE 
	c.activo = 1
GROUP BY 
	c.id, cta.moneda_id
ORDER BY 
	c.apellido, c.nombre;
	
ALTER TABLE compra	ADD COLUMN zona_id INT NOT NULL DEFAULT '1';
ALTER TABLE log_compra	ADD COLUMN zona_id INT NOT NULL DEFAULT '1';

ALTER TABLE lote	ADD COLUMN zona_id INT NOT NULL DEFAULT '1';
ALTER TABLE log_lote	ADD COLUMN zona_id INT NOT NULL DEFAULT '1';

CREATE TABLE descuento_zona (
	id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NULL,
	grupoprod_id INT NULL,
	porc_desc INT NULL,
	precio_desc INT NULL,
	zona_id INT NULL,
	PRIMARY KEY (id)
);

/*DROP VIEW ventas_zona;*/
CREATE VIEW ventas_zona as 
SELECT 
	dr.id,
	dr.id AS detalle_resumen_id,
	dr.resumen_id,
	r.fecha, 
	dr.producto_id, 
	r.cliente_id, 
	c.zona_id,
	dzp.porc_desc AS prod_porc_desc,
	dzg.porc_desc AS grupo_porc_desc,
	dzp.precio_desc AS prod_precio_desc,
	dzg.precio_desc AS grupo_precio_desc
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	JOIN cliente c ON r.cliente_id = c.id
	JOIN producto p ON dr.producto_id = p.id
	left outer JOIN descuento_zona dzp ON dr.producto_id = dzp.producto_id AND c.zona_id = dzp.zona_id
	left outer JOIN descuento_zona dzg ON p.grupoprod_id = dzg.grupoprod_id AND c.zona_id = dzg.zona_id;

INSERT INTO sf_guard_permission (id, name, description, created_at, updated_at, padre) VALUES 
('52', 'Descuento x Zona', '@descuento_zona', '2019-04-30 15:42:22', '2019-04-30 15:42:22', '10'),
('53', 'Ventas x Zona', '@ventas_zona', '2019-04-30 15:44:03', '2019-04-30 15:44:03', '10'),
('491', 'Zona', '@zona', '2019-04-30 15:44:03', '2019-04-30 15:44:03', '360'),
('492', 'Usuarios Zona', '@usuario_zona', '2019-04-30 15:44:03', '2019-04-30 15:44:03', '360');


ALTER TABLE resumen
	CHANGE COLUMN afip_mensaje afip_cae TEXT NULL AFTER afip_estado,
	ADD COLUMN afip_mensaje TEXT NULL AFTER afip_respuesta;

ALTER TABLE log_resumen
	CHANGE COLUMN afip_mensaje afip_cae TEXT NULL AFTER afip_estado,
	ADD COLUMN afip_mensaje TEXT NULL AFTER afip_respuesta;

INSERT INTO usuario_zona(zona_id, usuario) VALUES 
(1, 1),(1, 2),(1, 126),(1, 140),(1, 146),(1, 148);


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