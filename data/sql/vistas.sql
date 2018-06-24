DROP VIEW cta_cte;
CREATE VIEW cta_cte (
  id,concepto,numero,fecha,cliente_id,moneda_id,debe,haber,observacion
) AS 
select
  FLOOR(1+(RAND()*999999999999)), 
  'Venta',
  r.id, 
  r.fecha, 
  c.id, 
  d.moneda_id, 
  sum( d.total ) AS debe, 
  '0' AS haber,
  r.observacion
FROM resumen r
  JOIN detalle_resumen d ON r.id = d.resumen_id
  JOIN cliente c ON r.cliente_id = c.id
GROUP BY r.id, d.moneda_id
UNION
SELECT 
  FLOOR(1+(RAND()*999999999999)), 
  if(c.devprod_id is null, 'Cobro', 'Devolución'),
  c.id, 
  c.fecha, 
  cl.id, 
  c.moneda_id, 
  '0' AS debe, 
  sum( c.monto ) AS haber, 
  c.observacion
FROM cobro c
  JOIN cliente cl ON c.cliente_id = cl.id
GROUP BY c.id, c.moneda_id
ORDER BY fecha ASC;

DROP VIEW listado_cobros;    
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
JOIN cliente ON cobro.cliente_id = cliente.id;

DROP VIEW cta_cte_prov;
CREATE VIEW cta_cte_prov (
  id,concepto,numero,fecha,proveedor_id,cuenta_id, moneda_id,debe,haber,observacion
) AS 
select
  FLOOR(1+(RAND()*999999999999)), 
  'Compra',
  r.id, 
  r.fecha, 
  c.id,
  cu.id, 
  r.moneda_id, 
  '0' AS debe,
  sum( d.total ) AS haber,   
  r.observacion
FROM compra r
  JOIN detalle_compra d ON r.id = d.compra_id
  JOIN proveedor c ON r.proveedor_id = c.id
  JOIN cuenta_compras cu ON r.cuenta_id = cu.id
GROUP BY r.id
UNION
SELECT 
  FLOOR(1+(RAND()*999999999999)), 
  'Pago',
  c.id, 
  c.fecha, 
  cl.id, 
  cu.id, 
  c.moneda_id, 
  sum( c.monto ) AS debe, 
  '0' AS haber, 
  c.observacion
FROM pago c
  JOIN proveedor cl ON c.proveedor_id = cl.id
  JOIN cuenta_compras cu ON c.cuenta_id = cu.id
GROUP BY c.id
ORDER BY fecha ASC; 

DROP VIEW vta_fact;
CREATE VIEW vta_fact 
AS 
  select detalle_venta.id AS id,venta.fecha AS fecha,producto.id AS producto_id,producto.nombre AS nombre_prod,detalle_venta.cantidad AS cantidad 
  from detalle_venta 
  join venta on detalle_venta.venta_id = venta.id
  join producto on detalle_venta.producto_id = producto.id;

DROP VIEW comp_fact;  
CREATE VIEW comp_fact 
AS 
  select det_fact_compra.id AS id,fact_compra.fecha AS fecha,producto.id AS producto_id, producto.nombre AS nombre_prod,det_fact_compra.cantidad AS cantidad 
  from det_fact_compra 
  join fact_compra on det_fact_compra.factcompra_id = fact_compra.id 
  join producto on det_fact_compra.producto_id = producto.id;
  
DROP VIEW producto_traza; 
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

DROP VIEW cliente_ultima_compra;
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
  resumen.moneda_id,
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
order by
  producto.grupoprod_id, producto.orden_grupo, producto.nombre;
  
DROP VIEW listado_compras;
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
  
DROP VIEW control_stock;
CREATE VIEW control_stock (
 id,
 grupoprod_id,
 grupo_nombre,
 producto_id,
 producto_nombre,
 nro_lote,
 cant_comprada,
 cant_vendida,
 stock
) AS
SELECT
   FLOOR(1+(RAND()*999999999999)),
	p.grupoprod_id,
	gp.nombre,
	p.id,
	p.nombre,
	dc.nro_lote, SUM(dc.cantidad) AS cant_comprada,
	(
SELECT SUM(dr.cantidad + dr.bonificados)
FROM detalle_resumen dr
WHERE dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS cant_vendida, 
	(
SELECT (SUM(dc.cantidad) - SUM(dr.cantidad + dr.bonificados))
FROM detalle_resumen dr
WHERE dr.producto_id = dc.producto_id AND CONVERT(dr.nro_lote USING utf8) COLLATE utf8_spanish_ci = CONVERT(dc.nro_lote USING utf8) COLLATE utf8_spanish_ci
	) AS stock
FROM
	detalle_compra dc
JOIN producto p ON dc.producto_id = p.id
JOIN grupoprod gp ON p.grupoprod_id = gp.id
WHERE
	p.grupoprod_id NOT IN (1,15) AND p.activo = 1
GROUP BY
	p.id, p.nombre, dc.nro_lote
ORDER BY
	p.orden_grupo, p.nombre, dc.nro_lote;

DROP VIEW cliente_saldo;
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