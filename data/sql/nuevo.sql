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

ALTER TABLE detalle_resumen	ADD COLUMN det_remito_id INT NULL AFTER lote_id;

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

INSERT INTO zona (nombre) VALUES ('Central');
INSERT INTO zona (nombre) VALUES ('Sur');
INSERT INTO zona (nombre) VALUES ('Norte');

ALTER TABLE cliente	ADD COLUMN zona_id TINYINT(4) NOT NULL DEFAULT '1' AFTER recibir_curso;

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
ALTER TABLE lote	ADD COLUMN zona_id INT NOT NULL DEFAULT '1';

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