update resumen set zona_id = (select zona_id from cliente where resumen.cliente_id = cliente.id);
update dev_producto set zona_id = (select zona_id from cliente where dev_producto.cliente_id = cliente.id);
update cobro set zona_id = (select zona_id from cliente where cobro.cliente_id = cliente.id);

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
  detalle_resumen.det_remito_id
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