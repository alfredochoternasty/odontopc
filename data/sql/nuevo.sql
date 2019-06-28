DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select
  detalle_resumen.id,
  resumen.id as resumen_id,
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
	(select sum(cantidad) 	from dev_producto where detalle_resumen.producto_id = dev_producto.producto_id and detalle_resumen.nro_lote and dev_producto.nro_lote and resumen.id = dev_producto.resumen_id) as cant_dev
from
  resumen
    left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
    left join producto on detalle_resumen.producto_id = producto.id
where
  producto.grupoprod_id not in (1, 15)
  and resumen.tipofactura_id <> 4
  and detalle_resumen.nro_lote not in (select nro_lote from lotes_romi)
order by
  producto.grupoprod_id, producto.orden_grupo, producto.nombre;

DROP VIEW ventas_zona;
CREATE VIEW ventas_zona as
SELECT 
	dr.id,
	dr.id AS detalle_resumen_id,
	dr.resumen_id,
	r.fecha, 
	dr.producto_id, 
	p.grupoprod_id,
	dr.nro_lote,
	r.cliente_id, 
	c.zona_id,
	dzp.porc_desc AS prod_porc_desc,
	dzg.porc_desc AS grupo_porc_desc,
	dzp.precio_desc AS prod_precio_desc,
	dzg.precio_desc AS grupo_precio_desc,
	r.pagado AS cobrado,
	r.fecha_pagado as fecha_cobrado,
	r.pago_comision_id,
	case when r.pago_comision_id IS NOT NULL then 1 ELSE 0 END AS pagado
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	JOIN cliente c ON r.cliente_id = c.id
	JOIN producto p ON dr.producto_id = p.id
	left outer JOIN descuento_zona dzp ON dr.producto_id = dzp.producto_id AND c.zona_id = dzp.zona_id
	left outer JOIN descuento_zona dzg ON p.grupoprod_id = dzg.grupoprod_id AND c.zona_id = dzg.zona_id
where
	r.tipofactura_id <> 4;

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