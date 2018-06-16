delete from traza2;
delete from compra2;
ALTER TABLE detalle_compra	ADD COLUMN trazable TINYINT NOT NULL DEFAULT '0';
DROP VIEW producto_traza;  
CREATE VIEW producto_traza 
AS 
select
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
	dr.cantidad as cant_vendida,
	dc.cantidad as cant_comprada
from 
	producto p
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join detalle_compra dc on p.id = dc.producto_id and dr.nro_lote = dc.nro_lote
		join compra com on dc.compra_id = com.id
		join proveedor prov on com.proveedor_id = prov.id
where dc.trazable = 1;

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
	
update detalle_compra set trazable = 1 where nro_lote like 'T%' or exists(select '' from sf_guard_group where name = 'Blanco')


/*************************************** nuevo : 2018-06-13 ******************************************************/
update detalle_resumen set lista_id = (select lista_id from resumen where detalle_resumen.resumen_id = resumen.id)
update detalle_resumen set moneda_id = (select moneda_id from lista_precio where detalle_resumen.lista_id = lista_precio.id)

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
