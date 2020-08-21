DROP VIEW listado_cobros;
CREATE VIEW listado_cobros AS 
SELECT 
  cobro.id, 
  cobro.fecha, 
  cobro.cliente_id, 
  cobro.tipo_id, 
  cobro.moneda_id, 
  cobro.monto,
	cobro.zona_id,
	cobro.observacion
FROM cobro
	left outer join resumen r ON cobro.resumen_id = r.id
WHERE 
	r.tipofactura_id <> 4 or cobro.resumen_id = 0;