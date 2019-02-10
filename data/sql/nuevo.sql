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

	
CREATE TABLE lotes_romi (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nro_lote VARCHAR(50) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;

insert into lotes_romi(nro_lote)
select distinct nro_lote from detalle_compra dc join compra c on dc.compra_id =c.id where c.proveedor_id = 6

update lote 
set stock = (select stock_calculado from control_stock cs where cs.nro_lote = lote.nro_lote)
where nro_lote in (
'01-060618', '01-210218', '01-310518', '01035085003B/17', '01035115002E/17', '01035130002C/17', '01040085003B/17', '01040100002C/17', '01040115002C/17', '01040130001C/17', '02033020003/17', '02033030001/17', '02033030002/17', '02033040001/17', '02045045001/17', '04033025001/17', '04033035001/17', '04033045001/17', '04033055001/17', '04033065001/17', '04045015001/17', '04045025001/17', '04045035001/17', '04045045001/17', '05033015001/17', '05033065001/17', '05033075001/17', '05045015001/17', '05045045001/17', '30030005001/17', '0103501000002A/18', '0503300150001/18', '0503300350002/17', '0503300350002/18'
)


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