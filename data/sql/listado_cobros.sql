DROP VIEW listado_cobros;
CREATE VIEW listado_cobros (
  id,fecha,cliente,tipo_cliente,tipo_cobro,moneda,cli_gen_comis,monto, zona_id
) AS 
SELECT 
  cobro.id, 
  cobro.fecha, 
  cobro.cliente_id, 
  cliente.tipo_id, 
  cobro.tipo_id, 
  cobro.moneda_id, 
  cliente.genera_comision, 
  cobro.monto,
	cobro.zona_id
FROM cobro
	JOIN cliente ON cobro.cliente_id = cliente.id
	left outer join resumen r ON cobro.resumen_id = r.id
WHERE r.tipofactura_id <> 4 or cobro.resumen_id = 0;