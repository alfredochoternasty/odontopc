UPDATE sf_guard_permission SET name = 'Tipos de Ventas', description = '@tipo_venta' WHERE (id = '1430');

ALTER TABLE tipo_venta ADD COLUMN porc_recargo INT(11) NULL AFTER nombre;

INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 1 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 3 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 6 Cuota');
INSERT INTO tipo_venta (nombre) VALUES ('Tarj. Cred. 12 Cuota');
