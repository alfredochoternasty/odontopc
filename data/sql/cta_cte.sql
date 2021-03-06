DROP VIEW cta_cte;
CREATE VIEW cta_cte AS 
select
  d.id, 
  'Venta' as concepto,
  r.id as numero, 
  r.fecha, 
  c.id as cliente_id, 
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
  c.id, 
  if(c.devprod_id is null, 'Cobro', 'Devolución'),
  c.id as numero, 
  c.fecha, 
  cl.id as cliente_id, 
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