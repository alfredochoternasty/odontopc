update resumen set zona_id = (select zona_id from cliente where resumen.cliente_id = cliente.id);
update dev_producto set zona_id = (select zona_id from cliente where dev_producto.cliente_id = cliente.id);
update cobro set zona_id = (select zona_id from cliente where cobro.cliente_id = cliente.id);

update detalle_resumen set resumen_id = 3509 where resumen_id in (3380, 3306);
delete from resumen where id in (3380, 3306);
update compra set remito_id = 3509 where zona_id = 2 and remito_id is null;
update resumen set observacion = 'remitos unificados de amilcar - numeros 15 (15/05/2019) , 13 (12/04/2019) y 9 (01/04/2019)' where id = 3509;
update lote set fecha_vto = '2021-05-30' where producto_id = 238 and nro_lote = '01-310518' and zona_id = 2;

update detalle_resumen set cantidad = 10 where id = 12640;
update detalle_resumen set cantidad = 7 where id = 12643;
update detalle_resumen set cantidad = 13 where id = 12642;
update detalle_resumen set cantidad = 16 where id = 12680;
update detalle_resumen set cantidad = 15 where id = 12681;
update detalle_resumen set cantidad = 9 where id = 12682;
update detalle_resumen set cantidad = 7 where id = 12683;
update detalle_resumen set cantidad = 7 where id = 12684;
update detalle_resumen set cantidad = 10 where id = 12673;
update detalle_resumen set cantidad = 10 where id = 12674;
update detalle_resumen set cantidad = 6 where id = 12690;
update detalle_resumen set cantidad = 6 where id = 12691;
update detalle_resumen set cantidad = 6 where id = 12692;
update detalle_resumen set cantidad = 6 where id = 12707;
update detalle_resumen set cantidad = 9 where id = 12659;
update detalle_resumen set cantidad = 6 where id = 12679;
update detalle_resumen set cantidad = 6 where id = 12701;
update detalle_resumen set cantidad = 6 where id = 12703;
update detalle_resumen set cantidad = 6 where id = 12704;
update detalle_resumen set cantidad = 5 where id = 12698;

delete from detalle_resumen where id in (13137,13192,13193,13053,13052,13060,13061,13062,13134,13135,13049,13050,13051,13048,13136,13047,13054,13055,13056,13059);


INSERT INTO ventas.sf_guard_user_permission (user_id, permission_id, created_at, updated_at) VALUES ('191', '230', '2019-06-06 13:29:46', '2019-06-06 13:29:47');
INSERT INTO ventas.sf_guard_user_permission (user_id, permission_id, created_at, updated_at) VALUES ('191', '300', '2019-06-06 13:30:03', '2019-06-06 13:30:03');

DROP VIEW control_stock;
CREATE VIEW control_stock (
 id,
 producto_id,
 grupoprod_id,
 nro_lote,
 zona_id,
 comprados,
 vendidos,
 stock_guardado
) AS
SELECT
   l.id,
   l.producto_id,
	p.grupoprod_id,
	l.nro_lote,
	l.zona_id, 
	(	SELECT SUM(cantidad) 
		from detalle_compra dc 
			join compra on dc.compra_id = compra.id 
		where dc.nro_lote = l.nro_lote 
		and l.zona_id = compra.zona_id
	) AS cant_comprada,
	(
		SELECT SUM(dr.cantidad + dr.bonificados) - COALESCE((select sum(cantidad) from dev_producto dp where dp.producto_id = dr.producto_id and l.zona_id = dp.zona_id and dp.nro_lote= dr.nro_lote), 0) 
		FROM detalle_resumen dr 
			join resumen r on dr.resumen_id = r.id 
		WHERE r.remito_id is null 
			and dr.producto_id = l.producto_id 
			AND dr.nro_lote = l.nro_lote 
			and r.zona_id = l.zona_id
	) AS cant_vendida, 
	l.stock AS stock_guardado
FROM
	lote l
		JOIN producto p ON l.producto_id = p.id
		JOIN grupoprod gp ON p.grupoprod_id = gp.id
WHERE
	p.grupoprod_id NOT IN (1,15) 
	AND p.activo = 1 
	and l.nro_lote not in (select nro_lote from lotes_romi)
GROUP BY
   l.id, l.producto_id, p.grupoprod_id, l.nro_lote, l.zona_id, l.stock
ORDER BY
	p.orden_grupo, p.nombre, l.nro_lote;

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