DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	FLOOR(1+(RAND()*999999999999)) as id,
	c.dni, 
	c.apellido, 
	c.nombre, 
	tm.simbolo, 
	tm.nombre as moneda, 
	SUM(cta.debe - cta.haber) AS saldo
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
		LEFT JOIN tipo_moneda tm ON cta.moneda_id = tm.id 
WHERE 
	c.activo = 1
GROUP BY 
	tm.nombre, tm.simbolo, c.dni, c.apellido, c.nombre
ORDER BY 
	c.apellido asc;


/*
DROP TABLE 
	producto2, 
	traza2, 
	grupoprod2, 
	det_fact_compra, 
	venta, 
	detalle_venta, 
	detalle_resumen_antes_er, 
	cuenta_compras, 
	compra2,
	pago_compra.
	pago,
	lote_er;

DROP VIEW vta_fact, comp_fact, cta_cte_prov
*/