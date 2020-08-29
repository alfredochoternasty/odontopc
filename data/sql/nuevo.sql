ALTER TABLE sf_guard_user
	ADD COLUMN zona_id SMALLINT NULL DEFAULT NULL AFTER es_cliente;
	
INSERT INTO configuracion (id, valor) VALUES ('mail_from', 'alfredochoternasty@gmail.com');
INSERT INTO configuracion (id, valor) VALUES ('mail_from_nombre', 'NTI Implantes');
	
ALTER TABLE grupoprod ADD COLUMN foto VARCHAR(255) NULL DEFAULT NULL AFTER color;
ALTER TABLE grupoprod ADD COLUMN foto_chica VARCHAR(255) NULL DEFAULT NULL AFTER foto;
INSERT INTO configuracion (id, valor) VALUES ('mostrar_cabecera', 'S');
ALTER TABLE detalle_pedido CHANGE COLUMN cantidad cantidad SMALLINT NOT NULL DEFAULT 1 AFTER precio;
ALTER TABLE presupuesto ADD COLUMN telefono VARCHAR(50) NULL DEFAULT NULL AFTER email;

CREATE TABLE promocion (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  descripcion VARCHAR(45) NULL,
  estado TINYINT(1) NULL DEFAULT 1,
  fecha_ini DATE NOT NULL,
  fecha_fin DATE NULL,
  tipo_id TINYINT(1) NULL DEFAULT 1,
  min_cant SMALLINT(1) NULL DEFAULT 1,
  cant_regalo SMALLINT(1) NULL,
  porc_desc DECIMAL(5,2) NULL,
  aplica_neto TINYINT(1) NULL DEFAULT 0,
  lista_id INT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
CREATE TABLE log_promocion (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id INT,
  nombre VARCHAR(45) NOT NULL,
  descripcion VARCHAR(45) NULL,
  estado TINYINT(1) NULL DEFAULT 1,
  fecha_ini DATE NOT NULL,
  fecha_fin DATE NULL,
  tipo_id TINYINT(1) NULL DEFAULT 1,
  min_cant SMALLINT(1) NULL DEFAULT 1,
  cant_regalo SMALLINT(1) NULL,
  porc_desc DECIMAL(5,2) NULL,
  aplica_neto TINYINT(1) NULL DEFAULT 0,
  lista_id INT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
CREATE TABLE promocion_producto (
  id INT NOT NULL AUTO_INCREMENT,
  promocion_id INT NULL,
  producto_id INT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE log_promocion_producto (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id INT,
  promocion_id INT NULL,
  producto_id INT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
CREATE TABLE promocion_regalo (
  id INT NOT NULL AUTO_INCREMENT,
  promocion_id INT NULL,
  producto_id INT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE log_promocion_regalo (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id INT,
  promocion_id INT NULL,
  producto_id INT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE promocion 
CHANGE COLUMN nombre nombre VARCHAR(255) NOT NULL ,
CHANGE COLUMN descripcion descripcion VARCHAR(255) NULL DEFAULT NULL ;

ALTER TABLE detalle_pedido 
CHANGE COLUMN observacion observacion VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN asignacion_lote asignacion_lote VARCHAR(255) NULL DEFAULT NULL ;

INSERT INTO sf_guard_permission (id, name, description, padre)
VALUES ('275', 'Promociones', '@promocion', '230');

UPDATE sf_guard_permission SET name = 'Menu' WHERE (id = '510');
UPDATE sf_guard_permission SET name = 'Perfiles' WHERE (id = '500');
UPDATE sf_guard_permission SET name = 'Lista de Precios' WHERE (id = '270');
UPDATE sf_guard_permission SET name = 'Grupos' WHERE (id = '260');
UPDATE sf_guard_permission SET name = 'Presupuestos' WHERE (id = '250');
UPDATE sf_guard_permission SET name = 'Adm. de Productos' WHERE (id = '240');
UPDATE sf_guard_permission SET padre = '10' WHERE (id = '250');
UPDATE sf_guard_permission SET id = '45' WHERE (id = '250');
UPDATE sf_guard_user_permission SET permission_id = '45' WHERE (permission_id = '250');

delete FROM sf_guard_user_permission WHERE permission_id NOT IN (SELECT id FROM sf_guard_permission);

ALTER TABLE sf_guard_user_permission
	ADD CONSTRAINT permisos FOREIGN KEY (permission_id) REFERENCES sf_guard_permission (id) ON UPDATE CASCADE ON DELETE CASCADE,
	ADD CONSTRAINT usuarios FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO configuracion (id, valor) VALUES ('enviar_cliente', 'N');
INSERT INTO configuracion (id, valor) VALUES ('enviar_cliente_url', 'http://');

ALTER TABLE pedido 
ADD COLUMN zona_id INT(11) NULL,
ADD COLUMN usuario_id INT(11) NULL;

ALTER TABLE lote 
ADD COLUMN activo INT(1) NULL DEFAULT 1,
ADD COLUMN externo INT(11) NULL DEFAULT 0;

update lote set externo = 1, observacion = 'lote de roster/romi' where nro_lote in (SELECT nro_lote FROM lotes_romi);
update lote set activo = 0 where nro_lote like 'er%';
DELETE FROM lote WHERE (id = '243');
DELETE FROM lote WHERE (id = '262');

ALTER TABLE lote 
CHANGE COLUMN producto_id producto_id INT(11) NOT NULL ,
CHANGE COLUMN nro_lote nro_lote VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
CHANGE COLUMN usuario usuario_id INT(11) NULL DEFAULT NULL ;

ALTER TABLE log_lote CHANGE COLUMN usuario usuario_id INT(11) NULL DEFAULT NULL ;

CREATE TABLE log_cliente_domicilio (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id INT,
  cliente_id int(11) NOT NULL,
  direccion varchar(255) NOT NULL,
  telefono varchar(255) DEFAULT NULL,
  correo varchar(255) DEFAULT NULL,
  observacion varchar(255) DEFAULT NULL,
  localidad_id int(11) DEFAULT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
	lote_er,
  tabla_control_stock,
  tabla_listado_ventas,
	lotes_romi;

DROP VIEW vta_fact, comp_fact, cta_cte_prov;

CREATE TABLE log_pago_comision (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id INT,
  fecha date NOT NULL,
  revendedor_id int(11) NOT NULL,
  moneda_id int(11) NOT NULL DEFAULT '1',
  monto decimal(10,2) NOT NULL DEFAULT '1.00',
  tipo_id int(11) NOT NULL,
  banco_id int(11) DEFAULT NULL,
  referencia varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  fecha_vto date DEFAULT NULL,
  observacion varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  nro_recibo int(11) DEFAULT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE log_configuracion (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime ,
	log_operacion varchar(50),
  id varchar(200) NOT NULL,
  valor varchar(50) DEFAULT NULL,
  observacion varchar(200) DEFAULT NULL,
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE log_cobro ADD COLUMN nro_recibo int(11);
ALTER TABLE log_cobro ADD COLUMN zona_id int(11);
ALTER TABLE log_cobro ADD COLUMN archivo varchar(255);
ALTER TABLE log_compra ADD COLUMN remito_id int(11);
ALTER TABLE log_detalle_pedido ADD COLUMN asignacion_lote varchar(50);
ALTER TABLE log_detalle_presupuesto ADD COLUMN descuento int(11);
ALTER TABLE log_detalle_presupuesto ADD COLUMN sub_total decimal(10,0);
ALTER TABLE log_detalle_resumen ADD COLUMN descuento int(11);
ALTER TABLE log_dev_producto ADD COLUMN zona_id int(11);
ALTER TABLE log_dev_producto ADD COLUMN pago_comision_id int(11);
ALTER TABLE log_lote ADD COLUMN activo int(1);
ALTER TABLE log_lote ADD COLUMN externo int(11);
ALTER TABLE log_pedido ADD COLUMN cliente_domicilio_id int(11);
ALTER TABLE log_pedido ADD COLUMN zona_id int(11);
ALTER TABLE log_pedido ADD COLUMN usuario_id int(11);
ALTER TABLE log_presupuesto ADD COLUMN zona_id int(11);
ALTER TABLE log_presupuesto ADD COLUMN email varchar(100);
ALTER TABLE log_producto ADD COLUMN nombre_corto varchar(50);
ALTER TABLE log_producto ADD COLUMN foto varchar(255);
ALTER TABLE log_producto ADD COLUMN descripcion text;
ALTER TABLE log_producto ADD COLUMN foto_chica varchar(255);
ALTER TABLE log_resumen ADD COLUMN fecha_pagado date;
ALTER TABLE log_resumen ADD COLUMN pago_comision_id int(11);
ALTER TABLE log_resumen ADD COLUMN zona_id int(11);
ALTER TABLE log_tipo_factura ADD COLUMN nombre_corto varchar(50);
ALTER TABLE log_tipo_factura ADD COLUMN modelo_impresion varchar(50);
ALTER TABLE log_tipo_factura ADD COLUMN cond_fiscales varchar(50);
ALTER TABLE log_zona ADD COLUMN cliente_id int(11);
ALTER TABLE log_grupoprod ADD COLUMN foto varchar(255);
ALTER TABLE log_grupoprod ADD COLUMN foto_chica varchar(255);
ALTER TABLE log_presupuesto ADD COLUMN telefono varchar(50);
ALTER TABLE log_sf_guard_user ADD COLUMN zona_id smallint(6);

UPDATE sf_guard_permission SET name = 'Lotes' WHERE id = 280;
DELETE FROM sf_guard_permission WHERE  id=303;
UPDATE sf_guard_permission SET name='Traza de Productos' WHERE  id=290;

UPDATE grupoprod SET nombre = 'Instrumentales' WHERE (id = '11');
UPDATE grupoprod SET nombre = 'Aditamentos Fusion' WHERE (id = '13');
UPDATE grupoprod SET nombre = 'Extras' WHERE (id = '17');
UPDATE grupoprod SET nombre = 'Fresas Específicas' WHERE (id = '21');
UPDATE grupoprod SET nombre = 'Implantes Finos y Accesorios' WHERE (id = '22');

DELETE FROM grupoprod WHERE (id = '6');
DELETE FROM grupoprod WHERE (id = '16');

UPDATE producto SET grupoprod_id = '15' WHERE (id = '380');
UPDATE producto SET grupoprod_id = '15' WHERE (id = '309');
UPDATE producto SET grupoprod_id = '15' WHERE (id = '297');
UPDATE producto SET grupoprod_id = '15' WHERE (id = '295');
UPDATE producto SET grupoprod_id = '1' WHERE (id = '215');

CREATE TABLE categoria (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE log_categoria (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime,
	log_operacion varchar(50),
  id INT,
  nombre VARCHAR(255) NOT NULL,
  PRIMARY KEY (log_id));

ALTER TABLE grupoprod 
ADD COLUMN categoria_id INT NULL AFTER foto_chica;

INSERT INTO categoria (id, nombre) VALUES ('1', 'Implantes');
INSERT INTO categoria (id, nombre) VALUES ('2', 'Pilares');
INSERT INTO categoria (id, nombre) VALUES ('3', 'Tapones');
INSERT INTO categoria (id, nombre) VALUES ('4', 'Fresas');

UPDATE grupoprod SET categoria_id = '1' WHERE (id = '8');
UPDATE grupoprod SET categoria_id = '1' WHERE (id = '9');
UPDATE grupoprod SET categoria_id = '1' WHERE (id = '10');
UPDATE grupoprod SET categoria_id = '1' WHERE (id = '22');
UPDATE grupoprod SET categoria_id = '1' WHERE (id = '19');
UPDATE grupoprod SET categoria_id = '2' WHERE (id = '4');
UPDATE grupoprod SET categoria_id = '2' WHERE (id = '5');
UPDATE grupoprod SET categoria_id = '2' WHERE (id = '18');
UPDATE grupoprod SET categoria_id = '3' WHERE (id = '7');
UPDATE grupoprod SET categoria_id = '4' WHERE (id = '14');
UPDATE grupoprod SET categoria_id = '4' WHERE (id = '21');

ALTER TABLE cliente 
ADD COLUMN fecha_alta DATE NULL AFTER zona_id;

SET @tu_cliente = 0;

update cliente 
set fecha_alta = (select min(fecha) from resumen where resumen.cliente_id = cliente.id);

SET @tu_cliente = 1;

UPDATE dev_producto SET fecha = '2020-07-03' WHERE (id = '1018');

DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select 
	detalle_resumen.id AS id,
	resumen.id AS resumen_id,
	resumen.tipofactura_id AS tipofactura_id,
	resumen.fecha AS fecha,
	resumen.cliente_id AS cliente_id,
	resumen.zona_id AS zona_id,
	detalle_resumen.producto_id AS producto_id,
	producto.grupoprod_id AS grupoprod_id,
	producto.orden_grupo AS orden_grupo,
	producto.nombre AS nombre,
	detalle_resumen.nro_lote AS nro_lote,
	detalle_resumen.cantidad AS cantidad,
	detalle_resumen.bonificados AS bonificados,
	detalle_resumen.precio AS precio,
	detalle_resumen.iva AS iva,
	detalle_resumen.sub_total AS sub_total,
	detalle_resumen.total AS total,
	detalle_resumen.det_remito_id AS det_remito_id
from 
	resumen 
		left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		left join producto on detalle_resumen.producto_id = producto.id
		LEFT JOIN lote ON detalle_resumen.nro_lote = lote.nro_lote
where 
	producto.grupoprod_id not in (1,15)
	AND lote.externo = 0
	AND lote.activo = 1
UNION ALL
select 
	dev_producto.id AS id,
	dev_producto.resumen_id AS resumen_id,
	dev_producto.tipofactura_id AS tipofactura_id,
	dev_producto.fecha AS fecha,
	dev_producto.cliente_id AS cliente_id,
	dev_producto.zona_id AS zona_id,
	dev_producto.producto_id AS producto_id,
	producto.grupoprod_id AS grupoprod_id,
	producto.orden_grupo AS orden_grupo,
	producto.nombre AS nombre,
	dev_producto.nro_lote AS nro_lote,
	dev_producto.cantidad * -1 AS cantidad,
	0 AS bonificados,
	dev_producto.precio * -1 AS precio,
	dev_producto.iva * -1 AS iva,
	0 AS sub_total,
	dev_producto.total * -1 AS total,
	null
from 
	dev_producto
		left join producto on dev_producto.producto_id = producto.id
		LEFT JOIN lote ON dev_producto.nro_lote = lote.nro_lote
where 
	producto.grupoprod_id not in (1,15)
	AND lote.externo = 0
	AND lote.activo = 1;

drop view control_stock;
create view control_stock as
select 
	l.id AS id,
	l.producto_id AS producto_id,
	p.nombre AS nombre,
	p.grupoprod_id AS grupoprod_id,
	l.nro_lote AS nro_lote,
	l.zona_id AS zona_id,
	(
		select sum(dc.cantidad) 
		from 
			detalle_compra dc 
				join compra on dc.compra_id = compra.id 
		where dc.producto_id = l.producto_id and dc.nro_lote = l.nro_lote and l.zona_id = compra.zona_id and dc.nro_lote not like 'er%'
	) AS comprados,
	(
		select (sum(lv.cantidad) + sum(lv.bonificados))
		from listado_ventas lv 
		where 
			lv.nro_lote = l.nro_lote 
			and lv.cantidad >= 0
			and lv.producto_id = l.producto_id
			and lv.zona_id = l.zona_id 
			and (
						(isnull(lv.det_remito_id) and lv.zona_id = 1) 
						or (lv.det_remito_id is not null and lv.zona_id <> 1)
					)
	) AS vendidos,
	(
		select 
			sum(dp2.cantidad) 
		from 
			dev_producto dp2 
				join cliente c on dp2.cliente_id = c.id
		where 
			c.zona_id = l.zona_id 
			and dp2.producto_id = l.producto_id
			and dp2.nro_lote = l.nro_lote
			and exists(
							select 1 
							from resumen r2 
								join detalle_resumen dr2 on r2.id = dr2.resumen_id
							where r2.id = dp2.resumen_id
										and dr2.producto_id = l.producto_id
										and dr2.nro_lote = l.nro_lote
										and isnull(dr2.det_remito_id)
			)
	) AS cant_dev,
	l.stock AS stock_guardado,
	p.minimo_stock AS minimo_stock,
	(
		SELECT 
			case when max(r1.fecha) > COALESCE((select max(dp1.fecha) FROM dev_producto dp1 where dp1.producto_id = l.producto_id and dp1.nro_lote = l.nro_lote), '1900-01-01')
				then max(r1.fecha) 
				else (select max(dp1.fecha) FROM dev_producto dp1 where dp1.producto_id = l.producto_id and dp1.nro_lote = l.nro_lote)
			end
		from resumen r1 
			join detalle_resumen dr on r1.id = dr.resumen_id			
		where dr.producto_id = l.producto_id and dr.nro_lote = l.nro_lote
	) AS ult_venta 
from 
	lote l 
		join producto p on l.producto_id = p.id
		join grupoprod gp on p.grupoprod_id = gp.id
where 
	p.grupoprod_id not in (1,15)
	and p.activo = 1
	and l.activo = 1
	and l.externo = 0 
	and exists(select 1 from detalle_compra dc where dc.nro_lote = l.nro_lote and dc.producto_id = l.producto_id) 
group 
	by l.id,
	l.producto_id,
	p.grupoprod_id,
	l.nro_lote,
	l.zona_id,
	l.stock
order by 
	p.orden_grupo,
	p.nombre,
	l.nro_lote;
	
DROP VIEW listado_compras;
CREATE VIEW listado_compras AS 
select
  detalle_compra.id,
  detalle_compra.compra_id,
  compra.fecha,
  compra.proveedor_id,
  detalle_compra.producto_id,
  detalle_compra.precio,
  detalle_compra.cantidad,
  detalle_compra.total,
  producto.grupoprod_id,
  detalle_compra.nro_lote,
	compra.zona_id
from
  compra
    left join detalle_compra on compra.id = detalle_compra.compra_id
    left join producto on detalle_compra.producto_id = producto.id
    LEFT JOIN lote ON detalle_compra.nro_lote = lote.nro_lote
WHERE
	lote.externo = 0
	AND lote.activo = 1
order by
  producto.grupoprod_id, producto.orden_grupo;
	
DROP VIEW producto_traza;
CREATE VIEW producto_traza AS
SELECT
	dr.id AS id,
	r.id AS resumen_id,
	r.fecha AS fecha_venta,
	r.cliente_id,	
	dr.producto_id,
	replace(dr.nro_lote,	'T ',	'') AS nro_lote,
	l.fecha_vto,
	sum(dr.cantidad) + sum(dr.bonificados) as vendidos,
	(select sum(dp.cantidad) from dev_producto dp where dr.resumen_id = dp.resumen_id and dr.nro_lote = dp.nro_lote) AS devueltos
FROM
	detalle_resumen dr
		join resumen r on dr.resumen_id = r.id
		join lote l on dr.producto_id = l.producto_id and dr.nro_lote = l.nro_lote and r.zona_id = l.zona_id
WHERE 
	l.externo = 0
	AND l.activo = 1
	and r.tipofactura_id <> 4
group by
	r.id,
	r.fecha,
	r.cliente_id,	
	dr.producto_id,
	dr.nro_lote,
	l.fecha_vto
HAVING 
	vendidos > devueltos 
	or devueltos is null;
	
INSERT INTO sf_guard_permission (id, name, description, padre) VALUES ('340', 'Comisiones', '@Comisiones Menu', '0');
UPDATE sf_guard_permission SET id = '341', padre = '340' WHERE (id = '52');
UPDATE sf_guard_permission SET id = '342', padre = '340' WHERE (id = '53');
UPDATE sf_guard_permission SET id = '343', padre = '340' WHERE (id = '54');

ALTER TABLE cliente ADD COLUMN nro_matricula VARCHAR(255) NULL;
ALTER TABLE cliente ADD COLUMN foto_matricula VARCHAR(255) NULL;
ALTER TABLE localidad ADD COLUMN codigo_postal VARCHAR(255) NULL;
ALTER TABLE cliente ADD COLUMN modo_alta VARCHAR(255) NULL;

UPDATE sf_guard_permission SET id = '54' WHERE (id = '51');
UPDATE sf_guard_permission SET id = '52' WHERE (id = '304');
DELETE FROM sf_guard_permission WHERE (id = '150');
DELETE FROM sf_guard_permission WHERE (id = '160');
DELETE FROM sf_guard_permission WHERE (id = '221');
INSERT INTO sf_guard_permission (id, name, description, padre) VALUES ('305', 'Stock', '@Stock Menu', '0');
UPDATE sf_guard_permission SET id = '306', padre = '305' WHERE (id = '280');
UPDATE sf_guard_permission SET id = '308', padre = '305' WHERE (id = '300');
UPDATE sf_guard_permission SET name = 'Control de Stock' WHERE (id = '308');
DELETE FROM sf_guard_permission WHERE (id = '301');
DELETE FROM sf_guard_permission WHERE (id = '302');
DELETE FROM sf_guard_permission WHERE (id = '120');
INSERT INTO sf_guard_permission (id, name, description, padre) VALUES ('265', 'Categorias de Grupo', '@categoria', '230');
UPDATE sf_guard_permission SET name = 'Comisiones por Zona' WHERE (id = '341');
UPDATE sf_guard_permission SET name = 'Ventas por Zona' WHERE (id = '342');
UPDATE sf_guard_permission SET id = '150' WHERE (id = '340');
UPDATE sf_guard_permission SET id = '151', padre = '150' WHERE (id = '341');
UPDATE sf_guard_permission SET id = '152', padre = '150' WHERE (id = '342');
UPDATE sf_guard_permission SET id = '153', padre = '150' WHERE (id = '343');
DELETE FROM sf_guard_permission WHERE (id = '303');
DELETE FROM sf_guard_permission WHERE (id = '492');
DELETE FROM sf_guard_permission WHERE (id = '500');
DELETE FROM sf_guard_permission WHERE (id = '510');
UPDATE sf_guard_permission SET name = 'Zonas' WHERE (id = '491');

INSERT INTO configuracion (id, valor) VALUES ('login_css', 'login_nti.css');
INSERT INTO configuracion (id, valor) VALUES ('logo_cabecera', 'logo_nti_chico.png');
INSERT INTO configuracion (id, valor) VALUES ('logo_login', 'logo_nti_grande.png');

ALTER TABLE producto ADD COLUMN iva DECIMAL(10,2) NULL;
ALTER TABLE producto ADD COLUMN iva_porc DECIMAL(10,2) NULL;

UPDATE ventas.sf_guard_user SET zona_id = '1' WHERE (id = '2');
UPDATE ventas.sf_guard_user SET zona_id = '1' WHERE (id = '126');
UPDATE ventas.sf_guard_user SET zona_id = '2' WHERE (id = '191');
UPDATE ventas.sf_guard_user SET zona_id = '1' WHERE (id = '196');
UPDATE ventas.sf_guard_user SET zona_id = '3' WHERE (id = '223');
UPDATE ventas.sf_guard_user SET zona_id = '1' WHERE (id = '246');
UPDATE ventas.sf_guard_user SET zona_id = '1' WHERE (id = '247');