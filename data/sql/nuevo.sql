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

UPDATE resumen SET nro_factura='1' WHERE  id=2907;
UPDATE resumen SET nro_factura='2' WHERE  id=2973;
UPDATE resumen SET pto_vta='4' WHERE  id=2907;
UPDATE resumen SET pto_vta='4' WHERE  id=2973;
DELETE FROM detalle_resumen WHERE  id=8155;
DELETE FROM detalle_resumen WHERE  id=8748;
UPDATE dev_producto SET cantidad='5' WHERE  id=97;
UPDATE lote SET stock='0' WHERE  id=566;
UPDATE lote SET stock='0' WHERE  id=569;	
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
*/


ALTER TABLE log_sf_guard_forgot_password
	DROP INDEX user_id_idx;
ALTER TABLE log_sf_guard_group
	DROP INDEX name;
ALTER TABLE log_sf_guard_group_permission
	DROP INDEX sf_guard_group_permission_permission_id_sf_guard_permission_id;
ALTER TABLE log_sf_guard_permission
	DROP INDEX name;
ALTER TABLE log_sf_guard_remember_key
	DROP INDEX user_id_idx;
ALTER TABLE log_sf_guard_user_group
	DROP INDEX sf_guard_user_group_group_id_sf_guard_group_id;
ALTER TABLE log_sf_guard_user_group
	DROP INDEX sf_guard_user_group_group_id_sf_guard_group_id;
	
DROP TABLE log_sf_guard_user_group;
CREATE TABLE log_sf_guard_user_group (
	log_id INT(11) NOT NULL AUTO_INCREMENT,
	log_fecha DATETIME NOT NULL,
	log_operacion VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	user_id BIGINT(20) NOT NULL DEFAULT '0',
	group_id BIGINT(20) NOT NULL DEFAULT '0',
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (log_id)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

DROP TABLE log_sf_guard_group_permission;
CREATE TABLE log_sf_guard_group_permission (
	log_id INT(11) NOT NULL AUTO_INCREMENT,
	log_fecha DATETIME NOT NULL,
	log_operacion VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	group_id BIGINT(20) NOT NULL DEFAULT '0',
	permission_id BIGINT(20) NOT NULL DEFAULT '0',
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (log_id)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

DROP TABLE log_sf_guard_user_group;
CREATE TABLE log_sf_guard_user_group (
	log_id INT(11) NOT NULL AUTO_INCREMENT,
	log_fecha DATETIME NOT NULL,
	log_operacion VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	user_id BIGINT(20) NOT NULL DEFAULT '0',
	group_id BIGINT(20) NOT NULL DEFAULT '0',
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (log_id)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

DROP TABLE log_sf_guard_user_permission;
CREATE TABLE log_sf_guard_user_permission (
	log_id INT(11) NOT NULL AUTO_INCREMENT,
	log_fecha DATETIME NOT NULL,
	log_operacion VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	user_id BIGINT(20) NOT NULL DEFAULT '0',
	permission_id BIGINT(20) NOT NULL DEFAULT '0',
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (log_id)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
