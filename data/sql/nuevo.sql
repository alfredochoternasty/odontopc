ALTER TABLE detalle_resumen
	ADD COLUMN lista_id INT(11) NULL,
	ADD COLUMN moneda_id INT(11) NULL;

ALTER TABLE producto
	ADD COLUMN lista_id INT NULL;
	
update detalle_resumen set lista_id = (select lista_id from resumen where detalle_resumen.resumen_id = resumen.id);
update detalle_resumen set moneda_id = (select moneda_id from lista_precio where detalle_resumen.lista_id = lista_precio.id);

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
