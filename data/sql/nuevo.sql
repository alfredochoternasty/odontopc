ALTER TABLE tipo_venta ADD COLUMN porc_recargo INT(11) NULL AFTER nombre;

INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 1 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 3 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 6 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 12 Cuota');
