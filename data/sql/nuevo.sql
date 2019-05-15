ALTER TABLE zona	ADD COLUMN encargado VARCHAR(255) NOT NULL AFTER nombre;
ALTER TABLE zona ADD COLUMN cliente_id INT NOT NULL AFTER nombre, DROP COLUMN encargado;
ALTER TABLE pago_comision	ALTER cliente_id DROP DEFAULT;
ALTER TABLE pago_comision	CHANGE COLUMN cliente_id cliente VARCHAR(255) NOT NULL AFTER fecha;
ALTER TABLE resumen	ADD COLUMN fecha_pagado DATE NULL AFTER pagado;
ALTER TABLE pago_comision	ALTER cliente DROP DEFAULT; 
ALTER TABLE pago_comision	CHANGE COLUMN cliente revendedor_id INT NOT NULL AFTER fecha;
ALTER TABLE compra	ADD COLUMN remito_id INT(11) NULL AFTER zona_id;
insert into proveedor(id, cuit, razon_social, condicionfiscal_id) values(99, '30-71227246-1', 'NTI - Parana', 1)
	
DROP VIEW listado_ventas;
CREATE VIEW listado_ventas (
  id, 
  res_id, 
  fecha, 
  moneda_id, 
  moneda_nombre, 
  cliente_id, 
  cliente_apellido, 
  cliente_nombre, 
  tipo_id, 
  tipo_cliente_nombre, 
  cliente_genera_comision, 
  resumen_id, 
  producto_id, 
  precio, 
  cantidad, 
  bonificados, 
  total, 
  producto_nombre, 
  producto_genera_comision, 
  grupoprod_id, 
  grupo_nombre, 
  nro_lote,
  grupo2,
  grupo3,
  fecha_vto
) AS 
select
	detalle_resumen.id AS id,
  resumen.id AS res_id,
  resumen.fecha,
  detalle_resumen.moneda_id,
  tipo_moneda.nombre,
  resumen.cliente_id,
  cliente.apellido,
  cliente.nombre AS cliente_nombre,
  cliente.tipo_id,
  tipo_cliente.nombre tipo_cliente_nombre, 
  cliente.genera_comision,
  detalle_resumen.resumen_id,
  detalle_resumen.producto_id,
  detalle_resumen.precio,
  detalle_resumen.cantidad,
  detalle_resumen.bonificados,
  detalle_resumen.total,
  producto.nombre AS producto_nombre,
  producto.genera_comision,
  producto.grupoprod_id,
  grupoprod.nombre AS grupo_nombre,
  detalle_resumen.nro_lote,
  producto.grupo2,
  producto.grupo3,
  lote.fecha_vto
from
  resumen
    left join tipo_moneda on resumen.moneda_id = tipo_moneda.id
    left join cliente on resumen.cliente_id = cliente.id
    left join tipo_cliente on cliente.tipo_id = tipo_cliente.id
    left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
    left join producto on detalle_resumen.producto_id = producto.id
    left join grupoprod on producto.grupoprod_id = grupoprod.id
    left join lote on detalle_resumen.producto_id = lote.producto_id 
	 	and CONVERT(detalle_resumen.nro_lote using utf8) collate utf8_spanish_ci = CONVERT(lote.nro_lote using utf8) collate utf8_spanish_ci
where
  producto.grupoprod_id not in (1, 15)
  and resumen.remito_id is null
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