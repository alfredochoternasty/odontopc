ALTER TABLE tipo_factura ADD COLUMN nombre_corto VARCHAR(50) NULL;
ALTER TABLE producto ADD COLUMN nombre_corto VARCHAR(50) NULL;
ALTER TABLE pago_comision	CHANGE COLUMN numero referencia VARCHAR(50) NULL DEFAULT NULL AFTER banco_id;

CREATE VIEW listado_compras AS 
select
  detalle_compra.id,
  compra.id,
  compra.fecha,
  proveedor.id,
  detalle_compra.producto_id,
  detalle_compra.precio,
  detalle_compra.cantidad,
  detalle_compra.total,
  producto.grupoprod_id,
  detalle_compra.nro_lote,
	compra.zona_id
from
  compra
    left join detalle_compra on compra.id = detalle_compra.compra_id
    left join producto on detalle_compra.producto_id = producto.id
where
	detalle_compra.nro_lote not in (select nro_lote from lotes_romi)
order by
  producto.grupoprod_id, producto.orden_grupo;
	
DROP VIEW producto_traza;
CREATE VIEW producto_traza AS
select distinct
	dr.id,
	p.id as producto_id,
	p.codigo, 
	REPLACE(dc.nro_lote, 'T ', '') as nro_lote,
	COALESCE(dc.fecha_vto, 'no tiene') AS fecha_vto, 
	r.id as resumen_id,
	r.fecha as fecha_venta,
	c.id as cliente_id,
	c.apellido as apellido,
	c.nombre as nombre,
	com.fecha as fecha_compra,
	prov.id as proveedor_id,
	com.id as compra_id,
	case when dp.cantidad is null then dr.cantidad else (dr.cantidad - dp.cantidad) end as cant_vendida,
	dc.cantidad as cant_comprada
from 
	producto p
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join detalle_compra dc on dr.producto_id = dc.producto_id AND dr.nro_lote = dc.nro_lote
		join compra com on dc.compra_id = com.id AND r.zona_id = com.zona_id
		join proveedor prov on com.proveedor_id = prov.id
		left outer join dev_producto dp on dr.resumen_id = dp.resumen_id and dr.producto_id = dp.producto_id and dr.nro_lote and dp.nro_lote
where 
	dc.trazable = 1 
	and dr.nro_lote not in (select nro_lote from lotes_romi) 
	and dc.nro_lote not in (select nro_lote from lotes_romi)
	and proveedor_id <> 13
having 
	cant_vendida > 0;


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