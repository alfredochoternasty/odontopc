INSERT INTO sf_guard_permission (id, name, description, padre) 
VALUES ('1145', 'Ultima Compra', '@cliente_ultima_compra', '1090');

ALTER TABLE curso_inscripcion 
CHANGE COLUMN asistio asistio TINYINT(1) NULL DEFAULT 0 ,
CHANGE COLUMN pago pago TINYINT(1) NULL DEFAULT 0 ,
CHANGE COLUMN mas_info visto TINYINT(1) NULL DEFAULT 0 ;
