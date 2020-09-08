DROP VIEW listado_ventas;
CREATE VIEW listado_ventas AS 
select 
  detalle_resumen.id,
	resumen.id as resumen_id,
  resumen.cliente_id,
  detalle_resumen.producto_id,
	producto.grupoprod_id,
	resumen.zona_id,
	resumen.fecha,
  nro_lote,
  cantidad,
	tipofactura_id
from 
	resumen 
		left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		left join producto on producto.id = detalle_resumen.producto_id
UNION ALL
select 
	dev_producto.id,
	dev_producto.resumen_id,
	dev_producto.cliente_id,
	dev_producto.producto_id,
	producto.grupoprod_id,
	dev_producto.zona_id,
	dev_producto.fecha,
	dev_producto.nro_lote,
	dev_producto.cantidad * -1 AS cantidad,
	tipofactura_id
from 
	dev_producto
		left join producto on dev_producto.producto_id = producto.id;

CREATE TABLE detalle_pedido_original (
  id int(11) NOT NULL AUTO_INCREMENT,
  pedido_id int(11) NOT NULL,
  producto_id int(11) NOT NULL,
  precio decimal(10,2) NOT NULL DEFAULT 0.00,
  cantidad smallint(6) NOT NULL DEFAULT 1,
  total decimal(10,2) NOT NULL DEFAULT 0.00,
  observacion varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  nro_lote varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  asignacion_lote varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (id),
  KEY pedido_original_id_idx (pedido_id),
  KEY producto_original_id_idx (producto_id)
) ENGINE=InnoDB;
		
-- DROP TRIGGER IF EXISTS tu_pedido_finalizar;
DELIMITER $$
CREATE TRIGGER tu_pedido_finalizar AFTER UPDATE ON pedido
FOR EACH ROW
BEGIN
	if (NEW.finalizado = 1 and NEW.vendido = 0) then
		insert into detalle_pedido_original
		select * from detalle_pedido where pedido_id = NEW.id;
	end if;
END$$
DELIMITER ;

DELETE FROM ventas.zona WHERE (id = '4');
DELETE FROM ventas.usuario_zona WHERE (id = '14');
DELETE FROM ventas.usuario_zona WHERE (id = '15');
DELETE FROM ventas.usuario_zona WHERE (id = '16');
DELETE FROM ventas.usuario_zona WHERE (id = '29');
DELETE FROM ventas.usuario_zona WHERE (id = '32');
