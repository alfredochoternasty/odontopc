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
WHERE r.tipofactura_id <> 4 or cobro.resumen_id = 0;

ALTER TABLE detalle_resumen	ADD COLUMN lote_id INT NULL;
ALTER TABLE detalle_compra	ADD COLUMN lote_id INT NULL;
ALTER TABLE dev_producto	ADD COLUMN lote_id INT NULL;

delete from lote where nro_lote = '270/B021/16' AND compra_id = 40;
delete from lote WHERE id IN (107, 216, 196, 178, 263, 80, 217, 218);

UPDATE detalle_compra 
SET lote_id = (
	SELECT id 
	FROM lote 
	WHERE detalle_compra.nro_lote = lote.nro_lote 
	AND detalle_compra.producto_id = lote.producto_id
);

UPDATE detalle_resumen
SET lote_id = (
	SELECT id 
	FROM lote 
	WHERE detalle_resumen.nro_lote = lote.nro_lote 
	AND detalle_resumen.producto_id = lote.producto_id
);

UPDATE dev_producto
SET lote_id = (
	SELECT id 
	FROM lote 
	WHERE dev_producto.nro_lote = lote.nro_lote 
	AND dev_producto.producto_id = lote.producto_id
);

CREATE TABLE compra_lote (
	id INT NOT NULL AUTO_INCREMENT,
	compra_id INT NOT NULL,
	lote_id INT NOT NULL,
	PRIMARY KEY (id)
);

ALTER TABLE banco ENGINE=InnoDB;
ALTER TABLE cliente ENGINE=InnoDB;
ALTER TABLE cliente_seguimiento ENGINE=InnoDB;
ALTER TABLE cobro ENGINE=InnoDB;
ALTER TABLE cobro_resumen ENGINE=InnoDB;
ALTER TABLE compra ENGINE=InnoDB;
ALTER TABLE compra2 ENGINE=InnoDB;
ALTER TABLE condicion_fiscal ENGINE=InnoDB;
ALTER TABLE cuenta_compras ENGINE=InnoDB;
ALTER TABLE curso ENGINE=InnoDB;
ALTER TABLE curso_inscripcion ENGINE=InnoDB;
ALTER TABLE curso_mail_enviado ENGINE=InnoDB;
ALTER TABLE detalle_compra ENGINE=InnoDB;
ALTER TABLE detalle_pedido ENGINE=InnoDB;
ALTER TABLE detalle_presupuesto ENGINE=InnoDB;
ALTER TABLE detalle_resumen ENGINE=InnoDB;
ALTER TABLE detalle_resumen_antes_er ENGINE=InnoDB;
ALTER TABLE detalle_venta ENGINE=InnoDB;
ALTER TABLE det_fact_compra ENGINE=InnoDB;
ALTER TABLE det_lis_precio ENGINE=InnoDB;
ALTER TABLE dev_producto ENGINE=InnoDB;
ALTER TABLE fact_compra ENGINE=InnoDB;
ALTER TABLE grupoprod ENGINE=InnoDB;
ALTER TABLE grupoprod2 ENGINE=InnoDB;
ALTER TABLE lista_precio ENGINE=InnoDB;
ALTER TABLE localidad ENGINE=InnoDB;
ALTER TABLE lote ENGINE=InnoDB;
ALTER TABLE lote_er ENGINE=InnoDB;
ALTER TABLE pago ENGINE=InnoDB;
ALTER TABLE pago_compra ENGINE=InnoDB;
ALTER TABLE pedido ENGINE=InnoDB;
ALTER TABLE presupuesto ENGINE=InnoDB;
ALTER TABLE producto ENGINE=InnoDB;
ALTER TABLE producto2 ENGINE=InnoDB;
ALTER TABLE proveedor ENGINE=InnoDB;
ALTER TABLE provincia ENGINE=InnoDB;
ALTER TABLE resumen ENGINE=InnoDB;
ALTER TABLE sf_guard_forgot_password ENGINE=InnoDB;
ALTER TABLE sf_guard_group ENGINE=InnoDB;
ALTER TABLE sf_guard_group_permission ENGINE=InnoDB;
ALTER TABLE sf_guard_permission ENGINE=InnoDB;
ALTER TABLE sf_guard_remember_key ENGINE=InnoDB;
ALTER TABLE sf_guard_user ENGINE=InnoDB;
ALTER TABLE sf_guard_user_group ENGINE=InnoDB;
ALTER TABLE sf_guard_user_permission ENGINE=InnoDB;
ALTER TABLE tipo_cliente ENGINE=InnoDB;
ALTER TABLE tipo_cobro_pago ENGINE=InnoDB;
ALTER TABLE tipo_contacto ENGINE=InnoDB;
ALTER TABLE tipo_factura ENGINE=InnoDB;
ALTER TABLE tipo_inscripcion ENGINE=InnoDB;
ALTER TABLE tipo_moneda ENGINE=InnoDB;
ALTER TABLE tipo_motivo ENGINE=InnoDB;
ALTER TABLE tipo_respuesta ENGINE=InnoDB;
ALTER TABLE tipo_tiempo_contac ENGINE=InnoDB;
ALTER TABLE tipo_venta ENGINE=InnoDB;
ALTER TABLE traza2 ENGINE=InnoDB;
ALTER TABLE venta ENGINE=InnoDB;


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


UPDATE resumen SET afip_mensaje = NULL, afip_nro_comp = NULL, afip_vto_cae = NULL; 