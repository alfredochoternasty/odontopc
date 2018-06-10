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
  r.moneda_id, 
  sum( d.total ) AS debe, 
  '0' AS haber,
  r.observacion
FROM resumen r
  JOIN detalle_resumen d ON r.id = d.resumen_id
  JOIN cliente c ON r.cliente_id = c.id
GROUP BY r.id
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
GROUP BY c.id
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
		join detalle_compra dc on p.id = dc.producto_id and dr.nro_lote = dc.nro_lote
		join compra com on dc.compra_id = com.id
		join proveedor prov on com.proveedor_id = prov.id
		left outer join dev_producto dp on dr.resumen_id = dp.resumen_id and dr.producto_id = dp.producto_id and dr.nro_lote and dp.nro_lote33
where 
	dc.trazable = 1;
having 
	cant_vendida > 0

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
    left join lote on detalle_resumen.producto_id = lote.producto_id and detalle_resumen.nro_lote = lote.nro_lote
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
  producto_id, 
  grupoprod_id, 
  producto_nombre, 
  resumen_id, 
  fecha_vta, 
  nro_lote, 
  cantidad_vendida,
  cantidad_bonificados,
  cantidad_total,
  stock_actual, 
  stock_sin_lote,
  grupo2,
  grupo3
) AS 
select
	FLOOR(1+(RAND()*999999999999)),
	p.id,
	p.grupoprod_id, 
	p.nombre,
  r.id, 
	r.fecha,
	dr.nro_lote,
	sum(dr.cantidad),
	dr.bonificados,
	(dr.cantidad + dr.bonificados),
	l.stock,
  (select sum(l2.stock) from lote l2 where l2.producto_id = p.id),
  p.grupo2,
  p.grupo3
from
	producto p
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join lote l on dr.nro_lote = l.nro_lote and dr.producto_id = l.producto_id
where
	p.grupoprod_id not in (1,15) and p.activo = 1
group by
	p.id,
	p.grupoprod_id, 
	p.nombre,
  r.id,
	r.fecha,
	dr.nro_lote,
	dr.bonificados,
	l.stock,
	l.fecha_vto,
  p.grupo2,
  p.grupo3  
order by
	p.orden_grupo, p.nombre, r.fecha;

DROP VIEW cliente_ultima_compra;
CREATE VIEW cliente_ultima_compra  AS  
select 
	max(r.id) AS id,
	c.id AS cliente_id,
	c.apellido AS apellido,
	c.nombre AS nombre,
	max(r.fecha) AS fecha, 
	c.telefono AS telefono,
	c.celular AS celular,
	c.email AS email
from 
	cliente c 
		join resumen r on c.id = r.cliente_id 
group by 
	c.id,
	c.apellido,
	c.nombre ;




