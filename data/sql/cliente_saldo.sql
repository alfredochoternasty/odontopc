DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	c.id as id, 
	c.apellido, 
	c.nombre, 
	cta.moneda_id, 
	SUM(cta.debe - cta.haber) AS saldo,
	zona_id,
	(select max(fecha) from cobro where cliente_id = c.id) as ult_cobro,
	(select max(fecha) from resumen where cliente_id = c.id) as ult_venta
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
WHERE 
	c.activo = 1
GROUP BY 
	c.id, cta.moneda_id
ORDER BY 
	c.apellido, c.nombre;