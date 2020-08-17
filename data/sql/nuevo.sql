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
DELETE FROM ventas.sf_guard_permission WHERE  id=303;
UPDATE ventas.sf_guard_permission SET name='Traza de Productos' WHERE  id=290;

UPDATE ventas.grupoprod SET nombre = 'Instrumentales' WHERE (id = '11');
UPDATE ventas.grupoprod SET nombre = 'Aditamentos Fusion' WHERE (id = '13');
UPDATE ventas.grupoprod SET nombre = 'Extras' WHERE (id = '17');
UPDATE ventas.grupoprod SET nombre = 'Fresas Específicas' WHERE (id = '21');
UPDATE ventas.grupoprod SET nombre = 'Implantes Finos y Accesorios' WHERE (id = '22');

DELETE FROM ventas.grupoprod WHERE (id = '6');
DELETE FROM ventas.grupoprod WHERE (id = '16');

UPDATE ventas.producto SET grupoprod_id = '15' WHERE (id = '380');
UPDATE ventas.producto SET grupoprod_id = '15' WHERE (id = '309');
UPDATE ventas.producto SET grupoprod_id = '15' WHERE (id = '297');
UPDATE ventas.producto SET grupoprod_id = '15' WHERE (id = '295');
UPDATE ventas.producto SET grupoprod_id = '1' WHERE (id = '215');

update producto set nombre = '% Gastos Administrativos' where id = 380;
update producto set nombre = 'Actualización Precio' where id = 295;
update producto set nombre = 'Adaptador Para Criket Largo' where id = 198;
update producto set nombre = 'Análogo P/Pilar Múltiple 20°' where id = 340;
update producto set nombre = 'Análogo P/Pilar Múltiple 35°' where id = 341;
update producto set nombre = 'Análogo de Bronce' where id = 20;
update producto set nombre = 'Análogo de Titanio' where id = 254;
update producto set nombre = 'Análogo de Titanio' where id = 384;
update producto set nombre = 'Caja NTI Autoclavable' where id = 289;
update producto set nombre = 'Caja NTI Metálica' where id = 104;
update producto set nombre = 'Cápsula Para Provisorio 3,3 Laboratorio' where id = 301;
update producto set nombre = 'Cápsula Para Provisorio 4,5 Laboratorio' where id = 376;
update producto set nombre = 'Cargador de Hueso Doble' where id = 202;
update producto set nombre = 'Castroviejo' where id = 62;
update producto set nombre = 'Cazoleta de Retención Abierta' where id = 199;
update producto set nombre = 'Cicatrizal Ancho 4,5x3 V' where id = 113;
update producto set nombre = 'Cicatrizal Ancho 4,5x3,5' where id = 69;
update producto set nombre = 'Cicatrizal 3,3x2' where id = 55;
update producto set nombre = 'Cicatrizal 3,3x3' where id = 56;
update producto set nombre = 'Cicatrizal 3,3x4' where id = 57;
update producto set nombre = 'Cicatrizal 3,3x5' where id = 58;
update producto set nombre = 'Cicatrizal' where id = 118;
update producto set nombre = 'Cilindro Pilar Base Cromo con Hexágono 20º' where id = 351;
update producto set nombre = 'Cilindro Pilar Base Cromo con Hexágono 35º' where id = 353;
update producto set nombre = 'Cilindro Pilar Base Cromo sin Hexágono 20°' where id = 350;
update producto set nombre = 'Cilindro Pilar Base Cromo sin Hexágono 35º' where id = 352;
update producto set nombre = 'Cilindro Pilar Calcinable con Hexágono 20°' where id = 343;
update producto set nombre = 'Cilindro Pilar Calcinable con Hexágono 35°' where id = 345;
update producto set nombre = 'Cilindro Pilar Calcinable sin Hexágono 20°' where id = 342;
update producto set nombre = 'Cilindro Pilar Calcinable sin Hexágono 35°' where id = 344;
update producto set nombre = 'Cilindro Provisorio P/Pilar Múltiple con Hexágono 20°' where id = 347;
update producto set nombre = 'Cilindro Provisorio P/Pilar Múltiple con Hexágono 35°' where id = 349;
update producto set nombre = 'Cilindro Provisorio P/Pilar Múltiple sin Hexágono 20°' where id = 346;
update producto set nombre = 'Cilindro Provisorio P/Pilar Múltiple sin Hexágono 35°' where id = 348;
update producto set nombre = 'Cofia Azul Hombro' where id = 196;
update producto set nombre = 'Cofia NTI Para Muñon' where id = 72;
update producto set nombre = 'Colágeno EN Hebras 1ml Tissum' where id = 238;
update producto set nombre = 'Colágeno EN Hebras 2ml Tissum' where id = 292;
update producto set nombre = 'Cureta de Molt Econ' where id = 79;
update producto set nombre = 'Cursos Y Actualización' where id = 297;
update producto set nombre = 'Debito - Ajuste Cta Cte' where id = 309;
update producto set nombre = 'Destornillador L NTI  1,20 Hexagonal' where id = 236;
update producto set nombre = 'Destornillador M  NTI 1,20 Hexagonal' where id = 87;
update producto set nombre = 'Destornillador NTI Hex Ca' where id = 382;
update producto set nombre = 'Destornillador S NTI 1,20 Hexagonal' where id = 37;
update producto set nombre = 'Disector Recto' where id = 64;
update producto set nombre = 'Esculgar Canino-Premolar 13-14' where id = 311;
update producto set nombre = 'Esculgar Incisivo Central 11-21' where id = 310;
update producto set nombre = 'Esculgar Incisivo Lateral 12-22' where id = 312;
update producto set nombre = 'Esculgar Prov. Canino Premolar 13-14' where id = 327;
update producto set nombre = 'Esculgar Prov. Incisivo Central 11-21' where id = 313;
update producto set nombre = 'Esculgar Prov. Incisivo Lateral 12-22' where id = 314;
update producto set nombre = 'Extensor de Fresa Fino' where id = 147;
update producto set nombre = 'Extensor de Fresa' where id = 89;
update producto set nombre = 'Fisiodispenser (Consultar)' where id = 109;
update producto set nombre = 'Flete Según Destino' where id = 296;
update producto set nombre = 'Fresa Específica NTI ø3,5' where id = 23;
update producto set nombre = 'Fresa Específica NTI ø4,0' where id = 24;
update producto set nombre = 'Fresa Específica NTI ø4,5' where id = 25;
update producto set nombre = 'Fresa H NTI ø 2,2 L' where id = 256;
update producto set nombre = 'Fresa H NTI ø 2,2 M' where id = 28;
update producto set nombre = 'Fresa H NTI ø 2,2 S' where id = 288;
update producto set nombre = 'Fresa H NTI ø 2,5' where id = 111;
update producto set nombre = 'Fresa H NTI ø 2,8' where id = 29;
update producto set nombre = 'Fresa H NTI ø 3,0' where id = 257;
update producto set nombre = 'Fresa H NTI ø 3,2' where id = 99;
update producto set nombre = 'Fresa H NTI ø 3,5' where id = 101;
update producto set nombre = 'Fresa H NTI ø 3,7' where id = 100;
update producto set nombre = 'Fresa H NTI ø 4' where id = 102;
update producto set nombre = 'Fresa H NTI ø 4,2' where id = 103;
update producto set nombre = 'Fresa H NTI ø 4,5' where id = 105;
update producto set nombre = 'Fresa H Ti NTI ø 2,5' where id = 304;
update producto set nombre = 'Fresa H Ti NTI ø 3,0' where id = 308;
update producto set nombre = 'Fresa Piloto NTI ø3,5' where id = 250;
update producto set nombre = 'Fresa Piloto NTI ø3,75' where id = 251;
update producto set nombre = 'Fresa Piloto NTI ø4,0' where id = 252;
update producto set nombre = 'Fresa Piloto NTI ø4,5' where id = 253;
update producto set nombre = 'Fresa Redonda NTI ø2,5' where id = 82;
update producto set nombre = 'Fresa Redonda NTI ø3,0' where id = 83;
update producto set nombre = 'Fresa Ti NTI ø 2,2' where id = 386;
update producto set nombre = 'Fresa Ti NTI ø 2,8' where id = 305;
update producto set nombre = 'Fresa Ti NTI ø 3,2' where id = 307;
update producto set nombre = 'Fresa Ti NTI ø 3,5' where id = 306;
update producto set nombre = 'Fresa Ti NTI ø 3,7' where id = 302;
update producto set nombre = 'Fresa Ti NTI ø 4,2' where id = 303;
update producto set nombre = 'Fresa Específica 3,5 HD' where id = 74;
update producto set nombre = 'Fresa Específica 4 HD' where id = 75;
update producto set nombre = 'Fresa Específica 4,5 HD' where id = 76;
update producto set nombre = 'Fresero' where id = 123;
update producto set nombre = 'Implante Fusion 3,5 X 10' where id = 150;
update producto set nombre = 'Implante Fusion 3,5 X 11,5' where id = 151;
update producto set nombre = 'Implante Fusion 3,5 X 13' where id = 152;
update producto set nombre = 'Implante Fusion 3,5 X 15' where id = 153;
update producto set nombre = 'Implante Fusion 3,5 X 7' where id = 156;
update producto set nombre = 'Implante Fusion 3,5 X 8,5' where id = 155;
update producto set nombre = 'Implante Fusion 4,0 X 10' where id = 159;
update producto set nombre = 'Implante Fusion 4,0 X 11,5' where id = 160;
update producto set nombre = 'Implante Fusion 4,0 X 13' where id = 161;
update producto set nombre = 'Implante Fusion 4,0 X 15' where id = 162;
update producto set nombre = 'Implante Fusion 4,0 X 7' where id = 157;
update producto set nombre = 'Implante Fusion 4,0 X 8,5' where id = 158;
update producto set nombre = 'Implante Fusion 4,5 X 10' where id = 165;
update producto set nombre = 'Implante Fusion 4,5 X 11,5' where id = 166;
update producto set nombre = 'Implante Fusion 4,5 X 13' where id = 168;
update producto set nombre = 'Implante Fusion 4,5 X 15' where id = 167;
update producto set nombre = 'Implante Fusion 4,5 X 7' where id = 163;
update producto set nombre = 'Implante Fusion 4,5 X 8,5' where id = 164;
update producto set nombre = 'Hidroxiapatita 0,5 X 1 Fco Inbio' where id = 203;
update producto set nombre = 'Hidroxiapatita Idear 2g' where id = 26;
update producto set nombre = 'Hidroxiapatita Tissum 0,5gr Bovina' where id = 260;
update producto set nombre = 'Hidroxiapatita Tissum 1gr Bovina' where id = 200;
update producto set nombre = 'Hidroxiapatita' where id = 122;
update producto set nombre = 'Hoja Bisturí 15c' where id = 209;
update producto set nombre = 'Hueso 1cc Unc' where id = 114;
update producto set nombre = 'Hueso Porcino Tissum 0,5gr' where id = 261;
update producto set nombre = 'Hueso Porcino Tissum 1gr' where id = 201;
update producto set nombre = 'Hueso Unc 0,5 Cc' where id = 208;
update producto set nombre = 'Hueso Unc 0,5gr Humano' where id = 40;
update producto set nombre = 'Hueso Unc 1cc Humano' where id = 27;
update producto set nombre = 'Implante Fino 2,8 X 10mm' where id = 316;
update producto set nombre = 'Implante Fino 2,8 X 13mm' where id = 317;
update producto set nombre = 'Implante Fino 2,8 X 15mm' where id = 318;
update producto set nombre = 'Implante Fino 2,8 X 7mm' where id = 319;
update producto set nombre = 'Implante Fino 2,8 X 8,5mm' where id = 320;
update producto set nombre = 'Implante Fino 2,8 X11,5mm' where id = 321;
update producto set nombre = 'Implante Fusion HA 3,5x10' where id = 4;
update producto set nombre = 'Implante Fusion HA 3,5x11,5' where id = 5;
update producto set nombre = 'Implante Fusion HA 3,5x13' where id = 6;
update producto set nombre = 'Implante Fusion HA 3,5x15' where id = 7;
update producto set nombre = 'Implante Fusion HA 3,5x7' where id = 2;
update producto set nombre = 'Implante Fusion HA 3,5x8,5' where id = 3;
update producto set nombre = 'Implante Fusion HA 4,5x10' where id = 16;
update producto set nombre = 'Implante Fusion HA 4,5x11,5' where id = 17;
update producto set nombre = 'Implante Fusion HA 4,5x13' where id = 18;
update producto set nombre = 'Implante Fusion HA 4,5x15' where id = 19;
update producto set nombre = 'Implante Fusion HA 4,5x7' where id = 14;
update producto set nombre = 'Implante Fusion HA 4,5x8,5' where id = 15;
update producto set nombre = 'Implante Fusion HA 4x10' where id = 10;
update producto set nombre = 'Implante Fusion HA 4x11,5' where id = 11;
update producto set nombre = 'Implante Fusion HA 4x13' where id = 12;
update producto set nombre = 'Implante Fusion HA 4x15' where id = 13;
update producto set nombre = 'Implante Fusion HA 4x7' where id = 8;
update producto set nombre = 'Implante Fusion HA 4x8,5' where id = 9;
update producto set nombre = 'Implante Fusion Re 3,5 X 10,0' where id = 263;
update producto set nombre = 'Implante Fusion Re 3,5 X 11,5' where id = 264;
update producto set nombre = 'Implante Fusion Re 3,5 X 13,0' where id = 265;
update producto set nombre = 'Implante Fusion Re 3,5 X 15,0' where id = 266;
update producto set nombre = 'Implante Fusion Re 3,5 X 5,5' where id = 298;
update producto set nombre = 'Implante Fusion Re 3,5 X 7,0' where id = 286;
update producto set nombre = 'Implante Fusion Re 3,5 X 8,5' where id = 262;
update producto set nombre = 'Implante Fusion Re 3,75 X 10,0' where id = 269;
update producto set nombre = 'Implante Fusion Re 3,75 X 11,5' where id = 270;
update producto set nombre = 'Implante Fusion Re 3,75 X 13,0' where id = 271;
update producto set nombre = 'Implante Fusion Re 3,75 X 15,0' where id = 272;
update producto set nombre = 'Implante Fusion Re 3,75 X 5,5' where id = 299;
update producto set nombre = 'Implante Fusion Re 3,75 X 7,0' where id = 267;
update producto set nombre = 'Implante Fusion Re 3,75 X 8,5' where id = 268;
update producto set nombre = 'Implante Fusion Re 4 X 5,5' where id = 290;
update producto set nombre = 'Implante Fusion Re 4,00 X 10,0' where id = 275;
update producto set nombre = 'Implante Fusion Re 4,00 X 11,5' where id = 276;
update producto set nombre = 'Implante Fusion Re 4,00 X 13,0' where id = 277;
update producto set nombre = 'Implante Fusion Re 4,00 X 15,0' where id = 285;
update producto set nombre = 'Implante Fusion Re 4,00 X 5,5' where id = 287;
update producto set nombre = 'Implante Fusion Re 4,00 X 7,0' where id = 273;
update producto set nombre = 'Implante Fusion Re 4,00 X 8,5' where id = 274;
update producto set nombre = 'Implante Fusion Re 4,5 X 11,5' where id = 282;
update producto set nombre = 'Implante Fusion Re 4,5 X 13,0' where id = 283;
update producto set nombre = 'Implante Fusion Re 4,5 X 15,0' where id = 284;
update producto set nombre = 'Implante Fusion Re 4,5 X 5,5' where id = 300;
update producto set nombre = 'Implante Fusion Re 4,5 X 7,0' where id = 279;
update producto set nombre = 'Implante Fusion Re 4,5 X 8,5' where id = 280;
update producto set nombre = 'Implante Fusion Re 4,5 X10,0' where id = 281;
update producto set nombre = 'Implantes' where id = 115;
update producto set nombre = 'Intermediario Para Torquimetro M' where id = 38;
update producto set nombre = 'Intermediario Para Torquimetro S' where id = 258;
update producto set nombre = 'Interno' where id = 213;
update producto set nombre = 'Interno' where id = 214;
update producto set nombre = 'Interno' where id = 215;
update producto set nombre = 'Iva Facturado' where id = 1;
update producto set nombre = 'Kit Cofia Para Impresión Y Provisorio ø 3,3' where id = 231;
update producto set nombre = 'Kit Cofia Para Impresión Y Provisorio ø 4,5' where id = 232;
update producto set nombre = 'Kit Disyuntores NTI 1-2-3-4' where id = 248;
update producto set nombre = 'Kit Fracturadores de Piso Seno +3' where id = 377;
update producto set nombre = 'Kit Fracturadores de Piso Seno -3' where id = 378;
update producto set nombre = 'Kit NTI Osteotomos 2,5-2,8-3,2' where id = 31;
update producto set nombre = 'Kit Premium Odontología Estéril' where id = 255;
update producto set nombre = 'Kytinon' where id = 146;
update producto set nombre = 'Lanza' where id = 98;
update producto set nombre = 'Lindemann B' where id = 90;
update producto set nombre = 'Lindemann NTI' where id = 96;
update producto set nombre = 'Llave Ball Attached M' where id = 42;
update producto set nombre = 'Llave Ball Attached S' where id = 259;
update producto set nombre = 'Llave Colocadora de Pilar Mu?Ltiple' where id = 333;
update producto set nombre = 'Llave Colocadora Implante Fino S' where id = 322;
update producto set nombre = 'Mango de Bisturí Econ' where id = 70;
update producto set nombre = 'Mango de Bisturí Medesy' where id = 65;
update producto set nombre = 'Mango Digital' where id = 92;
update producto set nombre = 'Mango Transportador' where id = 385;
update producto set nombre = 'Membracel con Metronidazol' where id = 207;
update producto set nombre = 'Membracel G' where id = 120;
update producto set nombre = 'Membracel G' where id = 237;
update producto set nombre = 'Membracel Granulos X 2 Tubos' where id = 35;
update producto set nombre = 'Membracel' where id = 119;
update producto set nombre = 'Membracel' where id = 33;
update producto set nombre = 'Membrana de Hueso' where id = 121;
update producto set nombre = 'Membrana de Hueso' where id = 30;
update producto set nombre = 'Membrana de Pericardio 1,5x2' where id = 204;
update producto set nombre = 'Membracel M' where id = 36;
update producto set nombre = 'N Pilares Pasantes 3,3x6x7' where id = 180;
update producto set nombre = 'N Tornillos Pilares' where id = 194;
update producto set nombre = 'Orban' where id = 108;
update producto set nombre = 'Oring Uso Clínico' where id = 206;
update producto set nombre = 'Pic' where id = 93;
update producto set nombre = 'Pilar Ball Attached Kit Alt 3' where id = 228;
update producto set nombre = 'Pilar Ball Attached Kit Alt 4,5' where id = 229;
update producto set nombre = 'Pilar Ball Attached Kit Alt 5,5' where id = 234;
update producto set nombre = 'Pilar Ball Attached Kit Alt 1,5' where id = 291;
update producto set nombre = 'Pilar Bola Alt 3 Solo' where id = 48;
update producto set nombre = 'Pilar Bola Alt 4,5 Solo' where id = 211;
update producto set nombre = 'Pilar Bola Alt 5,5 Solo' where id = 235;
update producto set nombre = 'Pilar Directo 2da. Serie' where id = 95;
update producto set nombre = 'Pilar Múltiple 20° Alt. 2,0' where id = 334;
update producto set nombre = 'Pilar Múltiple 20° Alt. 3,0' where id = 335;
update producto set nombre = 'Pilar Múltiple 20° Alt. 4,0' where id = 336;
update producto set nombre = 'Pilar Múltiple 35° Alt. 2,0' where id = 337;
update producto set nombre = 'Pilar Múltiple 35° Alt. 3,0' where id = 338;
update producto set nombre = 'Pilar Múltiple 35° Alt. 4,0' where id = 339;
update producto set nombre = 'Pilar Multifunción IF + Tornillo Pilar IF' where id = 323;
update producto set nombre = 'Pilar Pasante Ancho  4,5x3,5x5' where id = 60;
update producto set nombre = 'Pilares Directo' where id = 117;
update producto set nombre = 'Pilar Directo 3,3x1,5x5' where id = 186;
update producto set nombre = 'Pilar Directo 3,3x2,5x5' where id = 187;
update producto set nombre = 'Pilar Directo 3,3x2,5x5' where id = 43;
update producto set nombre = 'Pilar Directo 3,3x3,5x5' where id = 188;
update producto set nombre = 'Pilar Directo 3,3x3,5x5' where id = 193;
update producto set nombre = 'Pilar Directo 3,3x3,5x5' where id = 44;
update producto set nombre = 'Pilar Directo 3,3x4,5x5' where id = 189;
update producto set nombre = 'Pilar Directo 3,3x4,5x5' where id = 45;
update producto set nombre = 'Pilar Directo 3,3x5,5x5' where id = 190;
update producto set nombre = 'Pilar Directo 3,3x6,5x5' where id = 219;
update producto set nombre = 'Pilar Directo 3,3x7,5x5' where id = 220;
update producto set nombre = 'Pilar Directo 3.3x5.5x5' where id = 47;
update producto set nombre = 'Pilar Directo 3.3x6x7' where id = 112;
update producto set nombre = 'Pilar Directo Ancho 4,5x1,5x5' where id = 191;
update producto set nombre = 'Pilar Directo Ancho 4,5x2,5x5' where id = 192;
update producto set nombre = 'Pilar Directo Ancho 4,5x2,5x5' where id = 46;
update producto set nombre = 'Pilar Directo Ancho 4,5x3,5x5' where id = 195;
update producto set nombre = 'Pilar Directo Ancho 4,5x3,5x5' where id = 22;
update producto set nombre = 'Pilar Directo Ancho 4,5x4,5x5' where id = 221;
update producto set nombre = 'Pilar Pasante 3,3x1,5x5' where id = 175;
update producto set nombre = 'Pilar Pasante 3,3x2,5x5' where id = 176;
update producto set nombre = 'Pilar Pasante 3,3x2,5x5' where id = 49;
update producto set nombre = 'Pilar Pasante 3,3x3,5x5' where id = 177;
update producto set nombre = 'Pilar Pasante 3,3x3,5x5' where id = 51;
update producto set nombre = 'Pilar Pasante 3,3x4,5x5' where id = 178;
update producto set nombre = 'Pilar Pasante 3,3x4,5x5' where id = 50;
update producto set nombre = 'Pilar Pasante 3,3x5,5x5' where id = 179;
update producto set nombre = 'Pilar Pasante 3,3x6,5x5' where id = 225;
update producto set nombre = 'Pilar Pasante 3,3x7,5x5' where id = 226;
update producto set nombre = 'Pilar Pasante Ancho 4,5x4,5x5' where id = 222;
update producto set nombre = 'Pilar Pasante Ancho 4,5x1,5x5' where id = 183;
update producto set nombre = 'Pilar Pasante Ancho 4,5x2,5x5' where id = 184;
update producto set nombre = 'Pilar Pasante Ancho 4,5x2,5x5' where id = 53;
update producto set nombre = 'Pilar Pasante Ancho 4,5x3,5x5' where id = 185;
update producto set nombre = 'Pilar Pasante Ancho 4,5x4,5x5' where id = 233;
update producto set nombre = 'Pilares Pasantes' where id = 116;
update producto set nombre = 'Pin Angulado 10º' where id = 210;
update producto set nombre = 'Pin Paralelizador Recto' where id = 91;
update producto set nombre = 'Pinza de Tejido Adson' where id = 61;
update producto set nombre = 'Ptp Ang 3,3x1,5x15º' where id = 242;
update producto set nombre = 'Ptp Ang 3,3x1,5x25º' where id = 245;
update producto set nombre = 'Ptp Ang 3,3x1,5x8º' where id = 239;
update producto set nombre = 'Ptp Ang 3,3x2,5x15º' where id = 243;
update producto set nombre = 'Ptp Ang 3,3x2,5x25º' where id = 246;
update producto set nombre = 'Ptp Ang 3,3x2,5x8º' where id = 240;
update producto set nombre = 'Ptp Ang 3,3x3,5x15º' where id = 244;
update producto set nombre = 'Ptp Ang 3,3x3,5x25º' where id = 247;
update producto set nombre = 'Ptp Ang 3,3x3,5x8º' where id = 241;
update producto set nombre = 'Regla Calco' where id = 212;
update producto set nombre = 'Regla Guia NTI' where id = 110;
update producto set nombre = 'Saldo Anterior' where id = 71;
update producto set nombre = 'Sus-Mem (1,5x2 Pericardio Porcino)' where id = 223;
update producto set nombre = 'Sus-Mem (2x3 Pericardio Porcino)' where id = 205;
update producto set nombre = 'Sutura Dafilon 4/0 Ds19 braun' where id = 77;
update producto set nombre = 'Sutura Dafilon 5/0 Ds19 braun' where id = 293;
update producto set nombre = 'Sutura Nylon Caja' where id = 78;
update producto set nombre = 'Tapa Cicatrizales NTI ø4,5x2,5' where id = 181;
update producto set nombre = 'Tapa de Cierre' where id = 80;
update producto set nombre = 'Tapón de Protección de Pilar Múltiple 35°' where id = 356;
update producto set nombre = 'Tapón de Protección de Pilar múltiple 20°' where id = 355;
update producto set nombre = 'Tapón NTI ø3,3x2' where id = 169;
update producto set nombre = 'Tapón NTI ø3,3x3' where id = 170;
update producto set nombre = 'Tapón NTI ø3,3x4' where id = 171;
update producto set nombre = 'Tapón NTI ø3,3x5' where id = 172;
update producto set nombre = 'Tapón NTI ø3,3x6' where id = 227;
update producto set nombre = 'Tapón NTI ø3,3x7' where id = 294;
update producto set nombre = 'Tapón NTI ø4,5x1,0' where id = 329;
update producto set nombre = 'Tapón NTI ø4,5x2,0' where id = 328;
update producto set nombre = 'Tapón NTI ø4,5x2,0' where id = 68;
update producto set nombre = 'Tapón NTI ø4,5x3,0' where id = 330;
update producto set nombre = 'Tapón NTI ø4,5x4,0' where id = 331;
update producto set nombre = 'Tapón NTI ø4,5x5,0' where id = 332;
update producto set nombre = 'Tapón Cicatrizal NTI ø4,5x3,5' where id = 174;
update producto set nombre = 'Tapón Cicatrizal NTI ø4,5x4,5' where id = 224;
update producto set nombre = 'Tapón Impl. Fino 3,5' where id = 315;
update producto set nombre = 'Tapón Impl. Fino 4,5' where id = 326;
update producto set nombre = 'Tijera Grande' where id = 66;
update producto set nombre = 'Tijera de Punto' where id = 63;
update producto set nombre = 'Tornillo de Fijación P/ Cilindro Pilar Múltiple' where id = 354;
update producto set nombre = 'Tornillo de Laboratorio de Cilindro Pilar Múltiple' where id = 357;
update producto set nombre = 'Tornillo NTI Para Carga Inmediata' where id = 230;
update producto set nombre = 'Tornillo Para Seno' where id = 381;
update producto set nombre = 'Tornillo Pilar Pasante NTI' where id = 94;
update producto set nombre = 'Torquimetro Progresivo' where id = 81;
update producto set nombre = 'Torquimetro Quiebre' where id = 41;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Abierta con Hex. 20°' where id = 363;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Abierta con Hex. 35°' where id = 365;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Abierta sin Hex. 20°' where id = 362;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Abierta sin Hex. 35°' where id = 364;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Cerrada con Hex. 20°' where id = 359;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Cerrada con Hex. 35°' where id = 361;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Cerrada sin Hex. 20°' where id = 358;
update producto set nombre = 'Transfer de Impresión Para Pilar Múltiple Cubeta Cerrada sin Hex. 35°' where id = 360;
update producto set nombre = 'Transfer de Impresión P/Pm Cc C/Hexágono 35º' where id = 387;
update producto set nombre = 'Transfer Impresión Cubeta Abierta con Tornillo' where id = 216;
update producto set nombre = 'Transfer Impresión Cubeta Cerrada con Tornillo' where id = 217;
update producto set nombre = 'Transfer Tornillo Pasante NTI Triangular' where id = 21;
update producto set nombre = 'Transportador Corto Implante Para Criket' where id = 107;
update producto set nombre = 'Transportador de Implante P/Seno' where id = 383;
update producto set nombre = 'Transportador Implante NTI M Para Contra Ángulo' where id = 39;
update producto set nombre = 'Transportador Implante NTI S Para Contra Ángulo' where id = 249;
update producto set nombre = 'Transportador Largo Implante Para Cricket' where id = 97;

CREATE TABLE ventas.categoria (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE ventas.log_categoria (
	log_id INT NOT NULL AUTO_INCREMENT,
	log_fecha datetime,
	log_operacion varchar(50),
  id INT,
  nombre VARCHAR(255) NOT NULL,
  PRIMARY KEY (log_id));

ALTER TABLE ventas.grupoprod 
ADD COLUMN categoria_id INT NULL AFTER foto_chica;

INSERT INTO ventas.categoria (id, nombre) VALUES ('1', 'Implantes');
INSERT INTO ventas.categoria (id, nombre) VALUES ('2', 'Pilares');
INSERT INTO ventas.categoria (id, nombre) VALUES ('3', 'Tapones');
INSERT INTO ventas.categoria (id, nombre) VALUES ('4', 'Fresas');

UPDATE ventas.grupoprod SET categoria_id = '1' WHERE (id = '8');
UPDATE ventas.grupoprod SET categoria_id = '1' WHERE (id = '9');
UPDATE ventas.grupoprod SET categoria_id = '1' WHERE (id = '10');
UPDATE ventas.grupoprod SET categoria_id = '1' WHERE (id = '22');
UPDATE ventas.grupoprod SET categoria_id = '1' WHERE (id = '19');
UPDATE ventas.grupoprod SET categoria_id = '2' WHERE (id = '4');
UPDATE ventas.grupoprod SET categoria_id = '2' WHERE (id = '5');
UPDATE ventas.grupoprod SET categoria_id = '2' WHERE (id = '18');
UPDATE ventas.grupoprod SET categoria_id = '3' WHERE (id = '7');
UPDATE ventas.grupoprod SET categoria_id = '4' WHERE (id = '14');
UPDATE ventas.grupoprod SET categoria_id = '4' WHERE (id = '21');

ALTER TABLE ventas.cliente 
ADD COLUMN fecha_alta DATE NULL AFTER zona_id;

SET @tu_cliente = 0;

update cliente 
set fecha_alta = (select min(fecha) from resumen where resumen.cliente_id = cliente.id);

SET @tu_cliente = 1;

UPDATE ventas.dev_producto SET fecha = '2020-07-03' WHERE (id = '1018');

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
	
INSERT INTO `ventas`.`sf_guard_permission` (`id`, `name`, `description`, `padre`) VALUES ('340', 'Comisiones', '@Comisiones Menu', '0');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '341', `padre` = '340' WHERE (`id` = '52');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '342', `padre` = '340' WHERE (`id` = '53');
UPDATE `ventas`.`sf_guard_permission` SET `id` = '343', `padre` = '340' WHERE (`id` = '54');
