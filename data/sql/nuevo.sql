ALTER TABLE dev_producto CHANGE COLUMN afip_estado afip_estado SMALLINT(6) NOT NULL DEFAULT '0';
ALTER TABLE cobro CHANGE COLUMN afip_estado afip_estado SMALLINT(6) NOT NULL DEFAULT '0';
ALTER TABLE resumen CHANGE COLUMN afip_estado afip_estado SMALLINT(6) NOT NULL DEFAULT '0';

ALTER TABLE resumen	ADD COLUMN zona_id INT NULL AFTER pago_comision_id;
ALTER TABLE dev_producto	ADD COLUMN zona_id INT NULL AFTER lote_id;
ALTER TABLE cobro	ADD COLUMN zona_id INT NULL AFTER nro_recibo;

update resumen set zona_id = (select zona_id from cliente where resumen.cliente_id = cliente.id);
update dev_producto set zona_id = (select zona_id from cliente where dev_producto.cliente_id = cliente.id);
update cobro set zona_id = (select zona_id from cliente where cobro.cliente_id = cliente.id);

DROP VIEW control_stock;
CREATE VIEW control_stock (
 id,
 proveedor_id,
 grupoprod_id,
 grupo_nombre,
 producto_id,
 producto_nombre,
 nro_lote,
 zona_id,
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
	l.zona_id, 
	SUM(dc.cantidad) AS cant_comprada,
	(
		SELECT SUM(dr.cantidad + dr.bonificados) - ifnull((select sum(cantidad) from dev_producto dp where dp.zona_id = 1 and dp.producto_id = dr.producto_id and CONVERT(dp.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci),0)
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.zona_id = 1 and r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS cant_vendida, 
	(
		SELECT (SUM(dc.cantidad) - SUM(dr.cantidad + dr.bonificados)) + ifnull((select sum(cantidad) from dev_producto dp where dp.zona_id = 1 and dp.producto_id = dr.producto_id and CONVERT(dp.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci),0)
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.zona_id = 1 and r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS stock_calculado,
	l.stock stock_guardado
FROM
	detalle_compra dc
JOIN compra c ON dc.compra_id = c.id
JOIN producto p ON dc.producto_id = p.id
JOIN grupoprod gp ON p.grupoprod_id = gp.id
JOIN lote l ON dc.producto_id = l.producto_id and CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(l.nro_lote USING utf8) COLLATE utf8_spanish_ci
WHERE
	p.grupoprod_id NOT IN (1,15) AND p.activo = 1 and l.zona_id = 1 and dc.nro_lote not in (select nro_lote from lotes_romi)
GROUP BY
	p.id, p.nombre, dc.nro_lote, l.zona_id
ORDER BY
	p.orden_grupo, p.nombre, dc.nro_lote;
	

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