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

CREATE VIEW producto_traza AS
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
  
CREATE VIEW listado_compras AS 
select
  detalle_compra.id,
  compra.id,
  compra.fecha,
  compra.proveedor_id,
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
		where ((lv.nro_lote = l.nro_lote) and (lv.producto_id = l.producto_id) and (lv.zona_id = l.zona_id) and (lv.tipofactura_id <> 4))
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
WHERE afip_estado > 0
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