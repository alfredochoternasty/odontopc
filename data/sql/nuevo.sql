DROP VIEW cta_cte;
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
	JOIN cliente ON cobro.cliente_id = cliente.id
	left outer join resumen r ON cobro.resumen_id = r.id
WHERE r.tipofactura_id <> 4 or c.resumen_id = 0;