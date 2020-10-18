DROP TRIGGER IF EXISTS tu_pedido;
DELIMITER $$
CREATE TRIGGER tu_pedido AFTER UPDATE ON pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.observacion, NEW.vendido, NEW.fecha_venta, NEW.direccion_entrega, NEW.forma_envio, NEW.finalizado, NEW.cliente_domicilio_id, NEW.zona_id, NEW.usuario_id);
	if (NEW.finalizado = 1 and OLD.finalizado = 0 and NEW.vendido = 0 and OLD.vendido = 0) then
		insert into detalle_pedido_original
		select * from detalle_pedido where pedido_id = NEW.id;
	end if;
END$$
DELIMITER ;

DROP VIEW cliente_saldo;
CREATE VIEW cliente_saldo AS
SELECT 
	c.id as id, 
	c.apellido, 
	c.nombre, 
	cta.moneda_id, 
	SUM(cta.debe - cta.haber) AS saldo,
	zona_id,
	(select max(fecha) from cobro where cliente_id = c.id) as ult_cobro,
	(select max(fecha) from resumen where cliente_id = c.id) as ult_venta
FROM 
	cliente c 
		LEFT JOIN cta_cte cta ON c.id = cta.cliente_id 
WHERE 
	c.activo = 1
GROUP BY 
	c.id, cta.moneda_id
ORDER BY 
	c.apellido, c.nombre;