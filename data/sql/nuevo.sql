DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	c.id as id, 
	c.apellido, 
	c.nombre, 
	cta.moneda_id, 
	SUM(cta.debe - cta.haber) AS saldo
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
WHERE 
	c.activo = 1
GROUP BY 
	c.id, cta.moneda_id
ORDER BY 
	c.apellido, c.nombre;

UPDATE ventas.resumen SET nro_factura='1' WHERE  id=2907;
UPDATE ventas.resumen SET nro_factura='2' WHERE  id=2973;
UPDATE ventas.resumen SET pto_vta='4' WHERE  id=2907;
UPDATE ventas.resumen SET pto_vta='4' WHERE  id=2973;
DELETE FROM `ventas`.`detalle_resumen` WHERE  `id`=8155;
DELETE FROM `ventas`.`detalle_resumen` WHERE  `id`=8748;
UPDATE `ventas`.`dev_producto` SET `cantidad`='5' WHERE  `id`=97;
UPDATE `ventas`.`lote` SET `stock`='0' WHERE  `id`=566;
UPDATE `ventas`.`lote` SET `stock`='0' WHERE  `id`=569;
	
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