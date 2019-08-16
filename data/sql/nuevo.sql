DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select
  detalle_resumen.id,
  resumen.id as resumen_id,
  resumen.tipofactura_id,
  resumen.fecha,
  resumen.cliente_id,
  resumen.zona_id,
  detalle_resumen.producto_id,
  producto.grupoprod_id, 
  producto.orden_grupo, 
  producto.nombre,
  detalle_resumen.nro_lote,
  detalle_resumen.cantidad,
  detalle_resumen.bonificados,
  detalle_resumen.precio,
  detalle_resumen.iva,
  detalle_resumen.sub_total,
  detalle_resumen.total,
  detalle_resumen.det_remito_id,
	(select sum(cantidad) from dev_producto where detalle_resumen.producto_id = dev_producto.producto_id and detalle_resumen.nro_lote and dev_producto.nro_lote and resumen.id = dev_producto.resumen_id) as cant_dev
from
  resumen
    left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
    left join producto on detalle_resumen.producto_id = producto.id
where
  producto.grupoprod_id not in (1, 15)
  and detalle_resumen.nro_lote not in (select nro_lote from lotes_romi)
order by
  producto.grupoprod_id, producto.orden_grupo, producto.nombre;

DROP VIEW control_stock;
CREATE VIEW control_stock AS
select 
	l.id AS id,
	l.producto_id AS producto_id,
	p.nombre AS nombre,
	p.grupoprod_id AS grupoprod_id,
	l.nro_lote AS nro_lote,
	l.zona_id AS zona_id,
	(select sum(dc.cantidad) from (detalle_compra dc join compra on((dc.compra_id = compra.id))) where ((dc.nro_lote = l.nro_lote) and (l.zona_id = compra.zona_id))) AS comprados,
	(
		select ((sum(lv.cantidad) + sum(lv.bonificados)) - coalesce(sum(lv.cant_dev),0)) 
		from listado_ventas lv 
		where ((lv.nro_lote = l.nro_lote) and (lv.producto_id = l.producto_id) and (lv.zona_id = l.zona_id) and ((lv.det_remito_id is null and lv.zona_id = 1) or (lv.det_remito_id is not null and lv.zona_id <> 1)))
	) AS vendidos,
	l.stock AS stock_guardado,
	p.minimo_stock AS minimo_stock,
	(select max(r.fecha) from (resumen r join detalle_resumen dr on((r.id = dr.resumen_id))) where ((dr.producto_id = l.producto_id) and (dr.nro_lote = l.nro_lote))) AS ult_venta 
from 
	((lote l 
		join producto p on((l.producto_id = p.id))) 
		join grupoprod gp on((p.grupoprod_id = gp.id))) 
where 
	((p.grupoprod_id not in (1,15)) 
	and (p.activo = 1) 
	and (not(l.nro_lote in (select lotes_romi.nro_lote from lotes_romi))) 
	and (not((l.nro_lote like 'er%'))) and exists(select 1 from detalle_compra dc where ((dc.nro_lote = l.nro_lote) and (dc.producto_id = l.producto_id)))) 
group by 
	l.id,
	l.producto_id,
	p.grupoprod_id,
	l.nro_lote,
	l.zona_id,
	l.stock order by p.orden_grupo,
	p.nombre,
	l.nro_lote;

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