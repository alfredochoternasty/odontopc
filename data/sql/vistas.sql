/*

SELECT tables.TABLE_NAME, CONCAT(
	'insert into ', 
	tables.TABLE_NAME, 
	'(log_fecha, log_operacion', 
	GROUP_CONCAT(COLUMN_NAME), 
	')', 
	' select now(), ''aca arregle los trigger'', ',GROUP_CONCAT(COLUMN_NAME),' from ', 
	SUBSTRING(tables.TABLE_NAME, 5), 
	' where id in (select distinct id from ', tables.TABLE_NAME,') ',
	';'
) 
FROM tables 
	JOIN columns ON tables.TABLE_NAME = columns.TABLE_NAME AND tables.table_schema = columns.table_schema
WHERE 
	tables.table_schema = 'ventas' 
	AND tables.TABLE_NAME LIKE 'log_%' 
	AND table_rows > 0  
	AND COLUMN_NAME NOT IN  ('log_id', 'log_fecha', 'log_operacion')
GROUP BY tables.TABLE_NAME
ORDER BY ORDINAL_POSITION

#SELECT COLUMN_NAME FROM columns WHERE TABLE_NAME = 'lote' AND table_schema = 'ventas'
select sum(cantidad) from detalle_resumen where nro_lote = '0103501000002A/18'

select nro_lote #*, case when (comprados - vendidos) = stock_calculado then 1 else 0 end as cal
from control_stock cs 
where 
cs.nro_lote not in (select nro_lote from lotes_romi) 
and (comprados - vendidos) <> stock_guardado 
and exists (
	select producto_id 
	from detalle_resumen dr 
		join resumen r on dr.resumen_id = r.id
	where r.fecha > '2018-06-01'
		and cs.producto_id = dr.producto_id
		and cs.nro_lote = dr.nro_lote
)

DROP VIEW cta_cte;
DROP VIEW listado_cobros;
DROP VIEW producto_traza;
DROP VIEW cliente_ultima_compra;
DROP VIEW listado_ventas;
DROP VIEW listado_compras;
DROP VIEW control_stock;
DROP VIEW cliente_saldo;
DROP VIEW lista_precio_detalle;
DROP VIEW facturas_afip;
DROP VIEW ventas_zona;

*/
CREATE VIEW cta_cte (
  id,concepto,numero,fecha,cliente_id,moneda_id,debe,haber,observacion
) AS 
select
  FLOOR(1+(RAND()*999999999999)), 
  'Venta',
  r.id as res_id, 
  r.fecha, 
  c.id as compra_id, 
  d.moneda_id, 
  sum( d.total ) AS debe, 
  '0' AS haber,
  r.observacion
FROM resumen r
  JOIN detalle_resumen d ON r.id = d.resumen_id
  JOIN cliente c ON r.cliente_id = c.id
WHERE r.tipofactura_id <> 4
GROUP BY r.id, d.moneda_id
UNION
SELECT 
  FLOOR(1+(RAND()*999999999999)), 
  if(c.devprod_id is null, 'Cobro', 'Devolución'),
  c.id as compra_id, 
  c.fecha, 
  cl.id as cli_id, 
  c.moneda_id, 
  '0' AS debe, 
  sum( c.monto ) AS haber, 
  c.observacion
FROM cobro c
  JOIN cliente cl ON c.cliente_id = cl.id
	left outer join resumen r ON c.resumen_id = r.id
WHERE r.tipofactura_id <> 4 or c.resumen_id = 0
GROUP BY c.id, c.moneda_id
ORDER BY fecha ASC;


CREATE VIEW listado_cobros (
  id,fecha,cliente,tipo_cliente,tipo_cobro,moneda,cli_gen_comis,monto
) AS 
SELECT 
  cobro.id, 
  cobro.fecha, 
  cobro.cliente_id, 
  cliente.tipo_id, 
  cobro.tipo_id, 
  cobro.moneda_id, 
  cliente.genera_comision, 
  cobro.monto
FROM cobro
	JOIN cliente ON cobro.cliente_id = cliente.id
	left outer join resumen r ON cobro.resumen_id = r.id
WHERE r.tipofactura_id <> 4 or cobro.resumen_id = 0;

CREATE VIEW producto_traza 
AS
select distinct
	dr.id,
	p.id as producto_id,
	p.codigo, 
	REPLACE(dc.nro_lote, 'T ', '') as nro_lote,
	dc.fecha_vto, 
	r.id as nro_venta,
	r.fecha as fecha_venta,
	c.id as cliente_id,
	c.apellido as apellido,
	c.nombre as nombre,
	com.fecha as fecha_compra,
	prov.id as proveedor_id,
	com.numero,
	case when dp.cantidad is null then dr.cantidad else (dr.cantidad - dp.cantidad) end as cant_vendida,
	dc.cantidad as cant_comprada
from 
	producto p
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join detalle_compra dc on p.id = dc.producto_id 
			and CONVERT(dr.nro_lote using utf8) collate utf8_spanish_ci = CONVERT(dc.nro_lote using utf8) collate utf8_spanish_ci
		join compra com on dc.compra_id = com.id
		join proveedor prov on com.proveedor_id = prov.id
		left outer join dev_producto dp on dr.resumen_id = dp.resumen_id and dr.producto_id = dp.producto_id and dr.nro_lote and dp.nro_lote
where 
	dc.trazable = 1 
	and dr.nro_lote not in (select nro_lote from lotes_romi) 
	and dc.nro_lote not in (select nro_lote from lotes_romi)
having 
	cant_vendida > 0;


CREATE VIEW cliente_ultima_compra AS select 
	id, 
	apellido, 
	nombre,
	telefono, 
	email, 
	celular,
	(select max(fecha) from resumen where cliente_id = cliente.id) as fecha
from cliente ;

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
  
CREATE VIEW listado_compras (
  id, compra_id, numero, fecha, moneda_id, moneda_nombre, prov_id, prov_raz_soc, producto_id, precio, cantidad, total, producto_nombre, grupoprod_id, grupo_nombre, nro_lote, grupo2, grupo3
) AS 
select
  FLOOR(1+(RAND()*999999999999)),
  compra.id,
  compra.numero,
  compra.fecha,
  compra.moneda_id,
  tipo_moneda.nombre,
  proveedor.id,
  proveedor.razon_social,
  detalle_compra.producto_id,
  detalle_compra.precio,
  detalle_compra.cantidad,
  detalle_compra.total,
  producto.nombre,
  producto.grupoprod_id,
  grupoprod.nombre,
  detalle_compra.nro_lote,
  producto.grupo2,
  producto.grupo3
from
  compra
    left join tipo_moneda on compra.moneda_id = tipo_moneda.id
    left join proveedor on compra.proveedor_id = proveedor.id
    left join detalle_compra on compra.id = detalle_compra.compra_id
    left join producto on detalle_compra.producto_id = producto.id
    left join grupoprod on producto.grupoprod_id = grupoprod.id
where  detalle_compra.nro_lote not in (select nro_lote from lotes_romi)
order by
  producto.grupoprod_id, producto.orden_grupo, producto.nombre;
  
CREATE VIEW control_stock (
 id,
 proveedor_id,
 grupoprod_id,
 grupo_nombre,
 producto_id,
 producto_nombre,
 nro_lote,
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
	SUM(dc.cantidad) AS cant_comprada,
	(
		SELECT SUM(dr.cantidad + dr.bonificados) - ifnull((select sum(cantidad) from dev_producto dp where dp.producto_id = dr.producto_id and CONVERT(dp.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci),0)
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS cant_vendida, 
	(
		SELECT (SUM(dc.cantidad) - SUM(dr.cantidad + dr.bonificados)) + ifnull((select sum(cantidad) from dev_producto dp where dp.producto_id = dr.producto_id and CONVERT(dp.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci),0)
		FROM detalle_resumen dr join resumen r on dr.resumen_id = r.id
		WHERE r.remito_id is null and dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS stock_calculado,
	l.stock stock_guardado
FROM
	detalle_compra dc
JOIN compra c ON dc.compra_id = c.id
JOIN producto p ON dc.producto_id = p.id
JOIN grupoprod gp ON p.grupoprod_id = gp.id
JOIN lote l ON dc.producto_id = l.producto_id and CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(l.nro_lote USING utf8) COLLATE utf8_spanish_ci
WHERE
	p.grupoprod_id NOT IN (1,15) AND p.activo = 1 and dc.nro_lote not in (select nro_lote from lotes_romi)
GROUP BY
	p.id, p.nombre, dc.nro_lote
ORDER BY
	p.orden_grupo, p.nombre, dc.nro_lote;

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

create view lista_precio_detalle as 
select
	FLOOR(1+(RAND()*999999999999)) as id,
	dlp.lista_id,
	lp.nombre,
	lp.moneda_id,
	dlp.grupoprod_id as grupo_id,
	g_p.id as producto_grupo_id,
	dlp.producto_id as producto_id,
	case when dlp.aumento is not null
		then g_p.precio_vta + (g_p.precio_vta/(dlp.aumento*100))
		else case when dlp.descuento is not null
					then g_p.precio_vta - (g_p.precio_vta / (dlp.descuento * 100))
					else case when dlp.precio is not null
								then dlp.precio
								else 0
							end
				end
	end as precio
from
	lista_precio lp
		join det_lis_precio dlp on lp.id = dlp.lista_id
		left outer join grupoprod gp on dlp.grupoprod_id = gp.id
		left outer join producto g_p on gp.id = g_p.grupoprod_id
		left outer join producto p on dlp.producto_id = p.id
where 
	lp.activo = 1;
	
CREATE VIEW facturas_afip as
SELECT
	r.id,
	r.tipofactura_id, 
	r.pto_vta, 
	r.nro_factura,
	fecha, 
	r.cliente_id,
	r.afip_cae AS cae,
	SUM(dr.iva) AS iva,
	SUM(dr.sub_total) AS neto,
	SUM(dr.total) AS total,
	concat(c.apellido, ' ', c.nombre) as cliente,
	c.zona_id
FROM resumen r
	JOIN detalle_resumen dr ON r.id = dr.resumen_id
	join cliente c ON r.cliente_id = c.id
WHERE afip_estado = 1
GROUP BY 
	r.id,
	r.pto_vta,
	r.nro_factura,
	fecha,
	r.cliente_id,
	r.afip_mensaje;

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