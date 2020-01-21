CREATE TABLE configuracion (
	id VARCHAR(200) NOT NULL,
	valor VARCHAR(50) NULL DEFAULT NULL,
	observacion VARCHAR(200) NULL DEFAULT NULL,
	PRIMARY KEY (id)
)
COLLATE='latin1_swedish_ci'
;

INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('base_url', '/odontopc_negro', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('cssmenu', 'cssmenu_n.css', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('favicon', 'favicon_n.ico', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('jquery', 'S', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('modulo_factura', 'N', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('cobro_alerta', 'S', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('cobro_alerta_mail', 'marcelamina@gmail.com', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('modulo_pedidos', 'N', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('modulo_seguimiento_clientes', 'N', NULL);
INSERT INTO `configuracion` (`id`, `valor`, `observacion`) VALUES ('cobro_modelo_impresion', 'recibo', NULL);

ALTER TABLE `tipo_factura`
	ADD COLUMN `modelo_impresion` VARCHAR(50) NULL DEFAULT NULL AFTER `nombre_corto`;

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