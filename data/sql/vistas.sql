/*
select sum(cantidad) from detalle_resumen where nro_lote = '0103501000002A/18'

select * from control_stock cs where (comprados - vendidos) <> stock_guardado 
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
  FLOOR(1+(RAND()*999999999999)),
  resumen.id,
  resumen.fecha,
  detalle_resumen.moneda_id,
  tipo_moneda.nombre,
  resumen.cliente_id,
  cliente.apellido,
  cliente.nombre,
  cliente.tipo_id,
  tipo_cliente.nombre, 
  cliente.genera_comision,
  detalle_resumen.resumen_id,
  detalle_resumen.producto_id,
  detalle_resumen.precio,
  detalle_resumen.cantidad,
  detalle_resumen.bonificados,
  detalle_resumen.total,
  producto.nombre,
  producto.genera_comision,
  producto.grupoprod_id,
  grupoprod.nombre,
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
	p.grupoprod_id NOT IN (1,15) AND p.activo = 1
GROUP BY
	p.id, p.nombre, dc.nro_lote
ORDER BY
	p.orden_grupo, p.nombre, dc.nro_lote;


CREATE VIEW cliente_saldo AS
SELECT 
	FLOOR(1+(RAND()*999999999999)),
	c.dni, 
	c.apellido, 
	c.nombre, 
	cta.id, 
	tc.nombre as tipo_cliente, 
	tm.simbolo, 
	tm.nombre as moneda, 
	FORMAT(SUM(cta.debe - cta.haber), 2) AS saldo, 
	MAX(fecha) AS fecha,
	cta.concepto
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
		LEFT JOIN tipo_cliente tc ON c.tipo_id = tc.id 
		LEFT JOIN tipo_moneda tm ON cta.moneda_id = tm.id 
WHERE 
	c.activo = 1
GROUP BY 
	tc.nombre, tm.nombre, c.dni, c.apellido, c.nombre 
ORDER BY 
	c.apellido asc;

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
	lp.activo = 1