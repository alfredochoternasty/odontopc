DROP TRIGGER IF EXISTS tu_banco;
DELIMITER $$
CREATE TRIGGER tu_banco AFTER UPDATE ON banco
FOR EACH ROW
BEGIN
	INSERT INTO log_banco (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_banco;
DELIMITER $$
CREATE TRIGGER td_banco AFTER DELETE ON banco
FOR EACH ROW
BEGIN
	INSERT INTO log_banco (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_cliente;
DELIMITER $$
CREATE TRIGGER ti_cliente AFTER INSERT ON cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.tipo_id, NEW.dni, NEW.cuit, NEW.condicionfiscal_id, NEW.genera_comision, NEW.sexo, NEW.apellido, NEW.nombre, NEW.fecha_nacimiento, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.celular, NEW.fax, NEW.email, NEW.observacion, NEW.usuario_id, NEW.lista_id, NEW.activo, NEW.recibir_curso, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_cliente;
DELIMITER $$
CREATE TRIGGER tu_cliente AFTER UPDATE ON cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.tipo_id, NEW.dni, NEW.cuit, NEW.condicionfiscal_id, NEW.genera_comision, NEW.sexo, NEW.apellido, NEW.nombre, NEW.fecha_nacimiento, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.celular, NEW.fax, NEW.email, NEW.observacion, NEW.usuario_id, NEW.lista_id, NEW.activo, NEW.recibir_curso, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_cliente;
DELIMITER $$
CREATE TRIGGER td_cliente AFTER DELETE ON cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.tipo_id, OLD.dni, OLD.cuit, OLD.condicionfiscal_id, OLD.genera_comision, OLD.sexo, OLD.apellido, OLD.nombre, OLD.fecha_nacimiento, OLD.domicilio, OLD.localidad_id, OLD.telefono, OLD.celular, OLD.fax, OLD.email, OLD.observacion, OLD.usuario_id, OLD.lista_id, OLD.activo, OLD.recibir_curso, OLD.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_cliente_domicilio;
DELIMITER $$
CREATE TRIGGER ti_cliente_domicilio AFTER INSERT ON cliente_domicilio
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.cliente_id, NEW.direccion, NEW.telefono, NEW.correo, NEW.observacion, NEW.localidad_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_cliente_domicilio;
DELIMITER $$
CREATE TRIGGER tu_cliente_domicilio AFTER UPDATE ON cliente_domicilio
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.cliente_id, NEW.direccion, NEW.telefono, NEW.correo, NEW.observacion, NEW.localidad_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_cliente_domicilio;
DELIMITER $$
CREATE TRIGGER td_cliente_domicilio AFTER DELETE ON cliente_domicilio
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.cliente_id, OLD.direccion, OLD.telefono, OLD.correo, OLD.observacion, OLD.localidad_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_cliente_seguimiento;
DELIMITER $$
CREATE TRIGGER ti_cliente_seguimiento AFTER INSERT ON cliente_seguimiento
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.cliente_id, NEW.fecha, NEW.hora, NEW.tipo_contacto_id, NEW.tipo_respuesta_id, NEW.comentario, NEW.prox_contac_fecha, NEW.prox_contac_hora, NEW.prox_contac_tiempo, NEW.prox_contact_coment, NEW.usuario, NEW.motivo_id, NEW.realizada);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_cliente_seguimiento;
DELIMITER $$
CREATE TRIGGER tu_cliente_seguimiento AFTER UPDATE ON cliente_seguimiento
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.cliente_id, NEW.fecha, NEW.hora, NEW.tipo_contacto_id, NEW.tipo_respuesta_id, NEW.comentario, NEW.prox_contac_fecha, NEW.prox_contac_hora, NEW.prox_contac_tiempo, NEW.prox_contact_coment, NEW.usuario, NEW.motivo_id, NEW.realizada);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_cliente_seguimiento;
DELIMITER $$
CREATE TRIGGER td_cliente_seguimiento AFTER DELETE ON cliente_seguimiento
FOR EACH ROW
BEGIN
	INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.cliente_id, OLD.fecha, OLD.hora, OLD.tipo_contacto_id, OLD.tipo_respuesta_id, OLD.comentario, OLD.prox_contac_fecha, OLD.prox_contac_hora, OLD.prox_contac_tiempo, OLD.prox_contact_coment, OLD.usuario, OLD.motivo_id, OLD.realizada);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_cobro;
DELIMITER $$
CREATE TRIGGER ti_cobro AFTER INSERT ON cobro
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.fecha_vto, NEW.devprod_id, NEW.observacion, NEW.usuario, NEW.nro_recibo, NEW.zona_id, NEW.archivo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_cobro;
DELIMITER $$
CREATE TRIGGER tu_cobro AFTER UPDATE ON cobro
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.fecha_vto, NEW.devprod_id, NEW.observacion, NEW.usuario, NEW.nro_recibo, NEW.zona_id, NEW.archivo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_cobro;
DELIMITER $$
CREATE TRIGGER td_cobro AFTER DELETE ON cobro
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.resumen_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.numero, OLD.fecha_vto, OLD.devprod_id, OLD.observacion, OLD.usuario, OLD.nro_recibo, OLD.zona_id, OLD.archivo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_cobro_resumen;
DELIMITER $$
CREATE TRIGGER ti_cobro_resumen AFTER INSERT ON cobro_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
	VALUES(NOW(), 'INSERT', NEW.cobro_id, NEW.resumen_id, NEW.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_cobro_resumen;
DELIMITER $$
CREATE TRIGGER tu_cobro_resumen AFTER UPDATE ON cobro_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
	VALUES(NOW(), 'UPDATE', NEW.cobro_id, NEW.resumen_id, NEW.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_cobro_resumen;
DELIMITER $$
CREATE TRIGGER td_cobro_resumen AFTER DELETE ON cobro_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
	VALUES(NOW(), 'DELETE', OLD.cobro_id, OLD.resumen_id, OLD.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_compra;
DELIMITER $$
CREATE TRIGGER ti_compra AFTER INSERT ON compra
FOR EACH ROW
BEGIN
	INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.cuenta_id, NEW.tipofactura_id, NEW.numero, NEW.fecha, NEW.proveedor_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.usuario, NEW.zona_id, NEW.remito_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_compra;
DELIMITER $$
CREATE TRIGGER tu_compra AFTER UPDATE ON compra
FOR EACH ROW
BEGIN
	INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.cuenta_id, NEW.tipofactura_id, NEW.numero, NEW.fecha, NEW.proveedor_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.usuario, NEW.zona_id, NEW.remito_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_compra;
DELIMITER $$
CREATE TRIGGER td_compra AFTER DELETE ON compra
FOR EACH ROW
BEGIN
	INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.cuenta_id, OLD.tipofactura_id, OLD.numero, OLD.fecha, OLD.proveedor_id, OLD.moneda_id, OLD.observacion, OLD.pagado, OLD.usuario, OLD.zona_id, OLD.remito_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_compra_lote;
DELIMITER $$
CREATE TRIGGER ti_compra_lote AFTER INSERT ON compra_lote
FOR EACH ROW
BEGIN
	INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.compra_id, NEW.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_compra_lote;
DELIMITER $$
CREATE TRIGGER tu_compra_lote AFTER UPDATE ON compra_lote
FOR EACH ROW
BEGIN
	INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.compra_id, NEW.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_compra_lote;
DELIMITER $$
CREATE TRIGGER td_compra_lote AFTER DELETE ON compra_lote
FOR EACH ROW
BEGIN
	INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.compra_id, OLD.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_condicion_fiscal;
DELIMITER $$
CREATE TRIGGER ti_condicion_fiscal AFTER INSERT ON condicion_fiscal
FOR EACH ROW
BEGIN
	INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cod_tipo_afip);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_condicion_fiscal;
DELIMITER $$
CREATE TRIGGER tu_condicion_fiscal AFTER UPDATE ON condicion_fiscal
FOR EACH ROW
BEGIN
	INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cod_tipo_afip);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_condicion_fiscal;
DELIMITER $$
CREATE TRIGGER td_condicion_fiscal AFTER DELETE ON condicion_fiscal
FOR EACH ROW
BEGIN
	INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cod_tipo_afip);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_configuracion;
DELIMITER $$
CREATE TRIGGER ti_configuracion AFTER INSERT ON configuracion
FOR EACH ROW
BEGIN
	INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.valor, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_configuracion;
DELIMITER $$
CREATE TRIGGER tu_configuracion AFTER UPDATE ON configuracion
FOR EACH ROW
BEGIN
	INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.valor, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_configuracion;
DELIMITER $$
CREATE TRIGGER td_configuracion AFTER DELETE ON configuracion
FOR EACH ROW
BEGIN
	INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.valor, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_curso;
DELIMITER $$
CREATE TRIGGER ti_curso AFTER INSERT ON curso
FOR EACH ROW
BEGIN
	INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.descripcion, NEW.fecha, NEW.hora, NEW.lugar, NEW.precio, NEW.mostrar_precio, NEW.logo, NEW.link_mapa, NEW.sitio_web, NEW.ini_insc, NEW.fin_insc, NEW.habilitado, NEW.permite_insc, NEW.foto1, NEW.foto2, NEW.foto3, NEW.foto4);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_curso;
DELIMITER $$
CREATE TRIGGER tu_curso AFTER UPDATE ON curso
FOR EACH ROW
BEGIN
	INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.descripcion, NEW.fecha, NEW.hora, NEW.lugar, NEW.precio, NEW.mostrar_precio, NEW.logo, NEW.link_mapa, NEW.sitio_web, NEW.ini_insc, NEW.fin_insc, NEW.habilitado, NEW.permite_insc, NEW.foto1, NEW.foto2, NEW.foto3, NEW.foto4);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_curso;
DELIMITER $$
CREATE TRIGGER td_curso AFTER DELETE ON curso
FOR EACH ROW
BEGIN
	INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.descripcion, OLD.fecha, OLD.hora, OLD.lugar, OLD.precio, OLD.mostrar_precio, OLD.logo, OLD.link_mapa, OLD.sitio_web, OLD.ini_insc, OLD.fin_insc, OLD.habilitado, OLD.permite_insc, OLD.foto1, OLD.foto2, OLD.foto3, OLD.foto4);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_curso_inscripcion;
DELIMITER $$
CREATE TRIGGER ti_curso_inscripcion AFTER INSERT ON curso_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.curso_id, NEW.cliente_id, NEW.nombre, NEW.correo, NEW.es_cliente, NEW.fecha, NEW.tipo_insc_id, NEW.comentario, NEW.asistio, NEW.pago_monto, NEW.mas_info, NEW.compro, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_curso_inscripcion;
DELIMITER $$
CREATE TRIGGER tu_curso_inscripcion AFTER UPDATE ON curso_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.curso_id, NEW.cliente_id, NEW.nombre, NEW.correo, NEW.es_cliente, NEW.fecha, NEW.tipo_insc_id, NEW.comentario, NEW.asistio, NEW.pago_monto, NEW.mas_info, NEW.compro, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_curso_inscripcion;
DELIMITER $$
CREATE TRIGGER td_curso_inscripcion AFTER DELETE ON curso_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.curso_id, OLD.cliente_id, OLD.nombre, OLD.correo, OLD.es_cliente, OLD.fecha, OLD.tipo_insc_id, OLD.comentario, OLD.asistio, OLD.pago_monto, OLD.mas_info, OLD.compro, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_curso_mail_enviado;
DELIMITER $$
CREATE TRIGGER ti_curso_mail_enviado AFTER INSERT ON curso_mail_enviado
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.curso_id, NEW.fecha, NEW.e_mail, NEW.lo_vio, NEW.se_inscribio, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_curso_mail_enviado;
DELIMITER $$
CREATE TRIGGER tu_curso_mail_enviado AFTER UPDATE ON curso_mail_enviado
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.curso_id, NEW.fecha, NEW.e_mail, NEW.lo_vio, NEW.se_inscribio, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_curso_mail_enviado;
DELIMITER $$
CREATE TRIGGER td_curso_mail_enviado AFTER DELETE ON curso_mail_enviado
FOR EACH ROW
BEGIN
	INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.curso_id, OLD.fecha, OLD.e_mail, OLD.lo_vio, OLD.se_inscribio, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_descuento_zona;
DELIMITER $$
CREATE TRIGGER ti_descuento_zona AFTER INSERT ON descuento_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.producto_id, NEW.grupoprod_id, NEW.porc_desc, NEW.precio_desc, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_descuento_zona;
DELIMITER $$
CREATE TRIGGER tu_descuento_zona AFTER UPDATE ON descuento_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.producto_id, NEW.grupoprod_id, NEW.porc_desc, NEW.precio_desc, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_descuento_zona;
DELIMITER $$
CREATE TRIGGER td_descuento_zona AFTER DELETE ON descuento_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.producto_id, OLD.grupoprod_id, OLD.porc_desc, OLD.precio_desc, OLD.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_det_lis_precio;
DELIMITER $$
CREATE TRIGGER ti_det_lis_precio AFTER INSERT ON det_lis_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.lista_id, NEW.producto_id, NEW.grupoprod_id, NEW.aumento, NEW.descuento, NEW.precio);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_det_lis_precio;
DELIMITER $$
CREATE TRIGGER tu_det_lis_precio AFTER UPDATE ON det_lis_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.lista_id, NEW.producto_id, NEW.grupoprod_id, NEW.aumento, NEW.descuento, NEW.precio);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_det_lis_precio;
DELIMITER $$
CREATE TRIGGER td_det_lis_precio AFTER DELETE ON det_lis_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.lista_id, OLD.producto_id, OLD.grupoprod_id, OLD.aumento, OLD.descuento, OLD.precio);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_detalle_compra;
DELIMITER $$
CREATE TRIGGER ti_detalle_compra AFTER INSERT ON detalle_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.compra_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.trazable, NEW.tiene_vto, NEW.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_detalle_compra;
DELIMITER $$
CREATE TRIGGER tu_detalle_compra AFTER UPDATE ON detalle_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.compra_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.trazable, NEW.tiene_vto, NEW.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_detalle_compra;
DELIMITER $$
CREATE TRIGGER td_detalle_compra AFTER DELETE ON detalle_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.compra_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.iva, OLD.sub_total, OLD.exportado, OLD.usuario, OLD.trazable, OLD.tiene_vto, OLD.lote_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_detalle_pedido;
DELIMITER $$
CREATE TRIGGER ti_detalle_pedido AFTER INSERT ON detalle_pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.pedido_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.asignacion_lote);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_detalle_pedido;
DELIMITER $$
CREATE TRIGGER tu_detalle_pedido AFTER UPDATE ON detalle_pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.pedido_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.asignacion_lote);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_detalle_pedido;
DELIMITER $$
CREATE TRIGGER td_detalle_pedido AFTER DELETE ON detalle_pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.pedido_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.observacion, OLD.nro_lote, OLD.asignacion_lote);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_detalle_presupuesto;
DELIMITER $$
CREATE TRIGGER ti_detalle_presupuesto AFTER INSERT ON detalle_presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.presupuesto_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.iva, NEW.descuento, NEW.sub_total);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_detalle_presupuesto;
DELIMITER $$
CREATE TRIGGER tu_detalle_presupuesto AFTER UPDATE ON detalle_presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.presupuesto_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.iva, NEW.descuento, NEW.sub_total);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_detalle_presupuesto;
DELIMITER $$
CREATE TRIGGER td_detalle_presupuesto AFTER DELETE ON detalle_presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.presupuesto_id, OLD.producto_id, OLD.cantidad, OLD.precio, OLD.total, OLD.iva, OLD.descuento, OLD.sub_total);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_detalle_resumen;
DELIMITER $$
CREATE TRIGGER ti_detalle_resumen AFTER INSERT ON detalle_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.resumen_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.bonificados, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.lista_id, NEW.moneda_id, NEW.cant_vend_remito, NEW.lote_id, NEW.det_remito_id, NEW.descuento);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_detalle_resumen;
DELIMITER $$
CREATE TRIGGER tu_detalle_resumen AFTER UPDATE ON detalle_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.resumen_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.bonificados, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.lista_id, NEW.moneda_id, NEW.cant_vend_remito, NEW.lote_id, NEW.det_remito_id, NEW.descuento);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_detalle_resumen;
DELIMITER $$
CREATE TRIGGER td_detalle_resumen AFTER DELETE ON detalle_resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.resumen_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.bonificados, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.iva, OLD.sub_total, OLD.exportado, OLD.usuario, OLD.lista_id, OLD.moneda_id, OLD.cant_vend_remito, OLD.lote_id, OLD.det_remito_id, OLD.descuento);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_dev_producto;
DELIMITER $$
CREATE TRIGGER ti_dev_producto AFTER INSERT ON dev_producto
FOR EACH ROW
BEGIN
	INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.usuario, NEW.iva, NEW.afip_vto_cae, NEW.afip_estado, NEW.afip_cae, NEW.pto_vta, NEW.tipofactura_id, NEW.nro_factura, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.lote_id, NEW.zona_id, NEW.pago_comision_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_dev_producto;
DELIMITER $$
CREATE TRIGGER tu_dev_producto AFTER UPDATE ON dev_producto
FOR EACH ROW
BEGIN
	INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.usuario, NEW.iva, NEW.afip_vto_cae, NEW.afip_estado, NEW.afip_cae, NEW.pto_vta, NEW.tipofactura_id, NEW.nro_factura, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.lote_id, NEW.zona_id, NEW.pago_comision_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_dev_producto;
DELIMITER $$
CREATE TRIGGER td_dev_producto AFTER DELETE ON dev_producto
FOR EACH ROW
BEGIN
	INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.resumen_id, OLD.producto_id, OLD.cantidad, OLD.precio, OLD.total, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.usuario, OLD.iva, OLD.afip_vto_cae, OLD.afip_estado, OLD.afip_cae, OLD.pto_vta, OLD.tipofactura_id, OLD.nro_factura, OLD.afip_envio, OLD.afip_respuesta, OLD.afip_mensaje, OLD.lote_id, OLD.zona_id, OLD.pago_comision_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_fact_compra;
DELIMITER $$
CREATE TRIGGER ti_fact_compra AFTER INSERT ON fact_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.proveedor_id, NEW.numero, NEW.tipofactura_id, NEW.fecha, NEW.moneda_id, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_fact_compra;
DELIMITER $$
CREATE TRIGGER tu_fact_compra AFTER UPDATE ON fact_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.proveedor_id, NEW.numero, NEW.tipofactura_id, NEW.fecha, NEW.moneda_id, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_fact_compra;
DELIMITER $$
CREATE TRIGGER td_fact_compra AFTER DELETE ON fact_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.proveedor_id, OLD.numero, OLD.tipofactura_id, OLD.fecha, OLD.moneda_id, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_grupoprod;
DELIMITER $$
CREATE TRIGGER ti_grupoprod AFTER INSERT ON grupoprod
FOR EACH ROW
BEGIN
	INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.color);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_grupoprod;
DELIMITER $$
CREATE TRIGGER tu_grupoprod AFTER UPDATE ON grupoprod
FOR EACH ROW
BEGIN
	INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.color);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_grupoprod;
DELIMITER $$
CREATE TRIGGER td_grupoprod AFTER DELETE ON grupoprod
FOR EACH ROW
BEGIN
	INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.color);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_lista_precio;
DELIMITER $$
CREATE TRIGGER ti_lista_precio AFTER INSERT ON lista_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.moneda_id, NEW.aumento, NEW.descuento, NEW.precio, NEW.defecto, NEW.activo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_lista_precio;
DELIMITER $$
CREATE TRIGGER tu_lista_precio AFTER UPDATE ON lista_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.moneda_id, NEW.aumento, NEW.descuento, NEW.precio, NEW.defecto, NEW.activo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_lista_precio;
DELIMITER $$
CREATE TRIGGER td_lista_precio AFTER DELETE ON lista_precio
FOR EACH ROW
BEGIN
	INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.moneda_id, OLD.aumento, OLD.descuento, OLD.precio, OLD.defecto, OLD.activo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_localidad;
DELIMITER $$
CREATE TRIGGER ti_localidad AFTER INSERT ON localidad
FOR EACH ROW
BEGIN
	INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.provincia_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_localidad;
DELIMITER $$
CREATE TRIGGER tu_localidad AFTER UPDATE ON localidad
FOR EACH ROW
BEGIN
	INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.provincia_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_localidad;
DELIMITER $$
CREATE TRIGGER td_localidad AFTER DELETE ON localidad
FOR EACH ROW
BEGIN
	INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.provincia_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_lote;
DELIMITER $$
CREATE TRIGGER ti_lote AFTER INSERT ON lote
FOR EACH ROW
BEGIN
	INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id, NEW.activo, NEW.externo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_lote;
DELIMITER $$
CREATE TRIGGER tu_lote AFTER UPDATE ON lote
FOR EACH ROW
BEGIN
	INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id, NEW.activo, NEW.externo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_lote;
DELIMITER $$
CREATE TRIGGER td_lote AFTER DELETE ON lote
FOR EACH ROW
BEGIN
	INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.producto_id, OLD.nro_lote, OLD.stock, OLD.fecha_vto, OLD.compra_id, OLD.observacion, OLD.usuario_id, OLD.zona_id, OLD.activo, OLD.externo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_pago;
DELIMITER $$
CREATE TRIGGER ti_pago AFTER INSERT ON pago
FOR EACH ROW
BEGIN
	INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.proveedor_id, NEW.cuenta_id, NEW.compra_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_pago;
DELIMITER $$
CREATE TRIGGER tu_pago AFTER UPDATE ON pago
FOR EACH ROW
BEGIN
	INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.proveedor_id, NEW.cuenta_id, NEW.compra_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_pago;
DELIMITER $$
CREATE TRIGGER td_pago AFTER DELETE ON pago
FOR EACH ROW
BEGIN
	INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.proveedor_id, OLD.cuenta_id, OLD.compra_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.numero, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_pago_comision;
DELIMITER $$
CREATE TRIGGER ti_pago_comision AFTER INSERT ON pago_comision
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.revendedor_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.referencia, NEW.fecha_vto, NEW.observacion, NEW.nro_recibo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_pago_comision;
DELIMITER $$
CREATE TRIGGER tu_pago_comision AFTER UPDATE ON pago_comision
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.revendedor_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.referencia, NEW.fecha_vto, NEW.observacion, NEW.nro_recibo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_pago_comision;
DELIMITER $$
CREATE TRIGGER td_pago_comision AFTER DELETE ON pago_comision
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.revendedor_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.referencia, OLD.fecha_vto, OLD.observacion, OLD.nro_recibo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_pago_compra;
DELIMITER $$
CREATE TRIGGER ti_pago_compra AFTER INSERT ON pago_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
	VALUES(NOW(), 'INSERT', NEW.pago_id, NEW.compra_id, NEW.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_pago_compra;
DELIMITER $$
CREATE TRIGGER tu_pago_compra AFTER UPDATE ON pago_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
	VALUES(NOW(), 'UPDATE', NEW.pago_id, NEW.compra_id, NEW.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_pago_compra;
DELIMITER $$
CREATE TRIGGER td_pago_compra AFTER DELETE ON pago_compra
FOR EACH ROW
BEGIN
	INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
	VALUES(NOW(), 'DELETE', OLD.pago_id, OLD.compra_id, OLD.monto);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_pedido;
DELIMITER $$
CREATE TRIGGER ti_pedido AFTER INSERT ON pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.observacion, NEW.vendido, NEW.fecha_venta, NEW.direccion_entrega, NEW.forma_envio, NEW.finalizado, NEW.cliente_domicilio_id, NEW.zona_id, NEW.usuario_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_pedido;
DELIMITER $$
CREATE TRIGGER tu_pedido AFTER UPDATE ON pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.observacion, NEW.vendido, NEW.fecha_venta, NEW.direccion_entrega, NEW.forma_envio, NEW.finalizado, NEW.cliente_domicilio_id, NEW.zona_id, NEW.usuario_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_pedido;
DELIMITER $$
CREATE TRIGGER td_pedido AFTER DELETE ON pedido
FOR EACH ROW
BEGIN
	INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.observacion, OLD.vendido, OLD.fecha_venta, OLD.direccion_entrega, OLD.forma_envio, OLD.finalizado, OLD.cliente_domicilio_id, OLD.zona_id, OLD.usuario_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_presupuesto;
DELIMITER $$
CREATE TRIGGER ti_presupuesto AFTER INSERT ON presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.lista_id, NEW.descripcion, NEW.zona_id, NEW.email);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_presupuesto;
DELIMITER $$
CREATE TRIGGER tu_presupuesto AFTER UPDATE ON presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.lista_id, NEW.descripcion, NEW.zona_id, NEW.email);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_presupuesto;
DELIMITER $$
CREATE TRIGGER td_presupuesto AFTER DELETE ON presupuesto
FOR EACH ROW
BEGIN
	INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.lista_id, OLD.descripcion, OLD.zona_id, OLD.email);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_producto;
DELIMITER $$
CREATE TRIGGER ti_producto AFTER INSERT ON producto
FOR EACH ROW
BEGIN
	INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.codigo, NEW.nombre, NEW.grupoprod_id, NEW.precio_vta, NEW.moneda_id, NEW.genera_comision, NEW.mueve_stock, NEW.minimo_stock, NEW.stock_actual, NEW.ctr_fact_grupo, NEW.orden_grupo, NEW.activo, NEW.grupo2, NEW.grupo3, NEW.lista_id, NEW.nombre_corto, NEW.foto, NEW.descripcion, NEW.foto_chica);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_producto;
DELIMITER $$
CREATE TRIGGER tu_producto AFTER UPDATE ON producto
FOR EACH ROW
BEGIN
	INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.codigo, NEW.nombre, NEW.grupoprod_id, NEW.precio_vta, NEW.moneda_id, NEW.genera_comision, NEW.mueve_stock, NEW.minimo_stock, NEW.stock_actual, NEW.ctr_fact_grupo, NEW.orden_grupo, NEW.activo, NEW.grupo2, NEW.grupo3, NEW.lista_id, NEW.nombre_corto, NEW.foto, NEW.descripcion, NEW.foto_chica);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_producto;
DELIMITER $$
CREATE TRIGGER td_producto AFTER DELETE ON producto
FOR EACH ROW
BEGIN
	INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.codigo, OLD.nombre, OLD.grupoprod_id, OLD.precio_vta, OLD.moneda_id, OLD.genera_comision, OLD.mueve_stock, OLD.minimo_stock, OLD.stock_actual, OLD.ctr_fact_grupo, OLD.orden_grupo, OLD.activo, OLD.grupo2, OLD.grupo3, OLD.lista_id, OLD.nombre_corto, OLD.foto, OLD.descripcion, OLD.foto_chica);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_proveedor;
DELIMITER $$
CREATE TRIGGER ti_proveedor AFTER INSERT ON proveedor
FOR EACH ROW
BEGIN
	INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.cuit, NEW.condicionfiscal_id, NEW.razon_social, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.email, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_proveedor;
DELIMITER $$
CREATE TRIGGER tu_proveedor AFTER UPDATE ON proveedor
FOR EACH ROW
BEGIN
	INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.cuit, NEW.condicionfiscal_id, NEW.razon_social, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.email, NEW.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_proveedor;
DELIMITER $$
CREATE TRIGGER td_proveedor AFTER DELETE ON proveedor
FOR EACH ROW
BEGIN
	INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.cuit, OLD.condicionfiscal_id, OLD.razon_social, OLD.domicilio, OLD.localidad_id, OLD.telefono, OLD.email, OLD.observacion);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_provincia;
DELIMITER $$
CREATE TRIGGER ti_provincia AFTER INSERT ON provincia
FOR EACH ROW
BEGIN
	INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_provincia;
DELIMITER $$
CREATE TRIGGER tu_provincia AFTER UPDATE ON provincia
FOR EACH ROW
BEGIN
	INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_provincia;
DELIMITER $$
CREATE TRIGGER td_provincia AFTER DELETE ON provincia
FOR EACH ROW
BEGIN
	INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_resumen;
DELIMITER $$
CREATE TRIGGER ti_resumen AFTER INSERT ON resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.lista_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.fecha_pagado, NEW.pedido_id, NEW.nro_factura, NEW.tipofactura_id, NEW.usuario, NEW.afip_estado, NEW.afip_cae, NEW.afip_nro_comp, NEW.afip_vto_cae, NEW.pto_vta, NEW.tipo_venta_id, NEW.remito_id, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.pago_comision_id, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_resumen;
DELIMITER $$
CREATE TRIGGER tu_resumen AFTER UPDATE ON resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.lista_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.fecha_pagado, NEW.pedido_id, NEW.nro_factura, NEW.tipofactura_id, NEW.usuario, NEW.afip_estado, NEW.afip_cae, NEW.afip_nro_comp, NEW.afip_vto_cae, NEW.pto_vta, NEW.tipo_venta_id, NEW.remito_id, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.pago_comision_id, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_resumen;
DELIMITER $$
CREATE TRIGGER td_resumen AFTER DELETE ON resumen
FOR EACH ROW
BEGIN
	INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.lista_id, OLD.moneda_id, OLD.observacion, OLD.pagado, OLD.fecha_pagado, OLD.pedido_id, OLD.nro_factura, OLD.tipofactura_id, OLD.usuario, OLD.afip_estado, OLD.afip_cae, OLD.afip_nro_comp, OLD.afip_vto_cae, OLD.pto_vta, OLD.tipo_venta_id, OLD.remito_id, OLD.afip_envio, OLD.afip_respuesta, OLD.afip_mensaje, OLD.pago_comision_id, OLD.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_forgot_password;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_forgot_password AFTER INSERT ON sf_guard_forgot_password
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.user_id, NEW.unique_key, NEW.expires_at, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_forgot_password;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_forgot_password AFTER UPDATE ON sf_guard_forgot_password
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.user_id, NEW.unique_key, NEW.expires_at, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_forgot_password;
DELIMITER $$
CREATE TRIGGER td_sf_guard_forgot_password AFTER DELETE ON sf_guard_forgot_password
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.user_id, OLD.unique_key, OLD.expires_at, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_group;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_group AFTER INSERT ON sf_guard_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_group;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_group AFTER UPDATE ON sf_guard_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_group;
DELIMITER $$
CREATE TRIGGER td_sf_guard_group AFTER DELETE ON sf_guard_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.name, OLD.description, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_group_permission;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_group_permission AFTER INSERT ON sf_guard_group_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.group_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_group_permission;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_group_permission AFTER UPDATE ON sf_guard_group_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.group_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_group_permission;
DELIMITER $$
CREATE TRIGGER td_sf_guard_group_permission AFTER DELETE ON sf_guard_group_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.group_id, OLD.permission_id, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_permission;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_permission AFTER INSERT ON sf_guard_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at, NEW.padre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_permission;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_permission AFTER UPDATE ON sf_guard_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at, NEW.padre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_permission;
DELIMITER $$
CREATE TRIGGER td_sf_guard_permission AFTER DELETE ON sf_guard_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.name, OLD.description, OLD.created_at, OLD.updated_at, OLD.padre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_remember_key;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_remember_key AFTER INSERT ON sf_guard_remember_key
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.user_id, NEW.remember_key, NEW.ip_address, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_remember_key;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_remember_key AFTER UPDATE ON sf_guard_remember_key
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.user_id, NEW.remember_key, NEW.ip_address, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_remember_key;
DELIMITER $$
CREATE TRIGGER td_sf_guard_remember_key AFTER DELETE ON sf_guard_remember_key
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.user_id, OLD.remember_key, OLD.ip_address, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_user;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_user AFTER INSERT ON sf_guard_user
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.first_name, NEW.last_name, NEW.email_address, NEW.username, NEW.algorithm, NEW.salt, NEW.password, NEW.is_active, NEW.is_super_admin, NEW.last_login, NEW.created_at, NEW.updated_at, NEW.es_cliente, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_user;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_user AFTER UPDATE ON sf_guard_user
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.first_name, NEW.last_name, NEW.email_address, NEW.username, NEW.algorithm, NEW.salt, NEW.password, NEW.is_active, NEW.is_super_admin, NEW.last_login, NEW.created_at, NEW.updated_at, NEW.es_cliente, NEW.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_user;
DELIMITER $$
CREATE TRIGGER td_sf_guard_user AFTER DELETE ON sf_guard_user
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.first_name, OLD.last_name, OLD.email_address, OLD.username, OLD.algorithm, OLD.salt, OLD.password, OLD.is_active, OLD.is_super_admin, OLD.last_login, OLD.created_at, OLD.updated_at, OLD.es_cliente, OLD.zona_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_user_group;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_user_group AFTER INSERT ON sf_guard_user_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.user_id, NEW.group_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_user_group;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_user_group AFTER UPDATE ON sf_guard_user_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.user_id, NEW.group_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_user_group;
DELIMITER $$
CREATE TRIGGER td_sf_guard_user_group AFTER DELETE ON sf_guard_user_group
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.user_id, OLD.group_id, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_sf_guard_user_permission;
DELIMITER $$
CREATE TRIGGER ti_sf_guard_user_permission AFTER INSERT ON sf_guard_user_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'INSERT', NEW.user_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_sf_guard_user_permission;
DELIMITER $$
CREATE TRIGGER tu_sf_guard_user_permission AFTER UPDATE ON sf_guard_user_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'UPDATE', NEW.user_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_sf_guard_user_permission;
DELIMITER $$
CREATE TRIGGER td_sf_guard_user_permission AFTER DELETE ON sf_guard_user_permission
FOR EACH ROW
BEGIN
	INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
	VALUES(NOW(), 'DELETE', OLD.user_id, OLD.permission_id, OLD.created_at, OLD.updated_at);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_cliente;
DELIMITER $$
CREATE TRIGGER ti_tipo_cliente AFTER INSERT ON tipo_cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_cliente;
DELIMITER $$
CREATE TRIGGER tu_tipo_cliente AFTER UPDATE ON tipo_cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_cliente;
DELIMITER $$
CREATE TRIGGER td_tipo_cliente AFTER DELETE ON tipo_cliente
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_cobro_pago;
DELIMITER $$
CREATE TRIGGER ti_tipo_cobro_pago AFTER INSERT ON tipo_cobro_pago
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_cobro_pago;
DELIMITER $$
CREATE TRIGGER tu_tipo_cobro_pago AFTER UPDATE ON tipo_cobro_pago
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_cobro_pago;
DELIMITER $$
CREATE TRIGGER td_tipo_cobro_pago AFTER DELETE ON tipo_cobro_pago
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_contacto;
DELIMITER $$
CREATE TRIGGER ti_tipo_contacto AFTER INSERT ON tipo_contacto
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_contacto;
DELIMITER $$
CREATE TRIGGER tu_tipo_contacto AFTER UPDATE ON tipo_contacto
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_contacto;
DELIMITER $$
CREATE TRIGGER td_tipo_contacto AFTER DELETE ON tipo_contacto
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_factura;
DELIMITER $$
CREATE TRIGGER ti_tipo_factura AFTER INSERT ON tipo_factura
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cod_tipo_afip, NEW.letra, NEW.id_fact_cancela, NEW.nombre_corto, NEW.modelo_impresion, NEW.cond_fiscales);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_factura;
DELIMITER $$
CREATE TRIGGER tu_tipo_factura AFTER UPDATE ON tipo_factura
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cod_tipo_afip, NEW.letra, NEW.id_fact_cancela, NEW.nombre_corto, NEW.modelo_impresion, NEW.cond_fiscales);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_factura;
DELIMITER $$
CREATE TRIGGER td_tipo_factura AFTER DELETE ON tipo_factura
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cod_tipo_afip, OLD.letra, OLD.id_fact_cancela, OLD.nombre_corto, OLD.modelo_impresion, OLD.cond_fiscales);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_inscripcion;
DELIMITER $$
CREATE TRIGGER ti_tipo_inscripcion AFTER INSERT ON tipo_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_inscripcion;
DELIMITER $$
CREATE TRIGGER tu_tipo_inscripcion AFTER UPDATE ON tipo_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_inscripcion;
DELIMITER $$
CREATE TRIGGER td_tipo_inscripcion AFTER DELETE ON tipo_inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_moneda;
DELIMITER $$
CREATE TRIGGER ti_tipo_moneda AFTER INSERT ON tipo_moneda
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.simbolo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_moneda;
DELIMITER $$
CREATE TRIGGER tu_tipo_moneda AFTER UPDATE ON tipo_moneda
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.simbolo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_moneda;
DELIMITER $$
CREATE TRIGGER td_tipo_moneda AFTER DELETE ON tipo_moneda
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.simbolo);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_motivo;
DELIMITER $$
CREATE TRIGGER ti_tipo_motivo AFTER INSERT ON tipo_motivo
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_motivo;
DELIMITER $$
CREATE TRIGGER tu_tipo_motivo AFTER UPDATE ON tipo_motivo
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_motivo;
DELIMITER $$
CREATE TRIGGER td_tipo_motivo AFTER DELETE ON tipo_motivo
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_respuesta;
DELIMITER $$
CREATE TRIGGER ti_tipo_respuesta AFTER INSERT ON tipo_respuesta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_respuesta;
DELIMITER $$
CREATE TRIGGER tu_tipo_respuesta AFTER UPDATE ON tipo_respuesta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_respuesta;
DELIMITER $$
CREATE TRIGGER td_tipo_respuesta AFTER DELETE ON tipo_respuesta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_tiempo_contac;
DELIMITER $$
CREATE TRIGGER ti_tipo_tiempo_contac AFTER INSERT ON tipo_tiempo_contac
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_tiempo_contac;
DELIMITER $$
CREATE TRIGGER tu_tipo_tiempo_contac AFTER UPDATE ON tipo_tiempo_contac
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_tiempo_contac;
DELIMITER $$
CREATE TRIGGER td_tipo_tiempo_contac AFTER DELETE ON tipo_tiempo_contac
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_tipo_venta;
DELIMITER $$
CREATE TRIGGER ti_tipo_venta AFTER INSERT ON tipo_venta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_tipo_venta;
DELIMITER $$
CREATE TRIGGER tu_tipo_venta AFTER UPDATE ON tipo_venta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_tipo_venta;
DELIMITER $$
CREATE TRIGGER td_tipo_venta AFTER DELETE ON tipo_venta
FOR EACH ROW
BEGIN
	INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_usuario_zona;
DELIMITER $$
CREATE TRIGGER ti_usuario_zona AFTER INSERT ON usuario_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.zona_id, NEW.usuario);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_usuario_zona;
DELIMITER $$
CREATE TRIGGER tu_usuario_zona AFTER UPDATE ON usuario_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.zona_id, NEW.usuario);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_usuario_zona;
DELIMITER $$
CREATE TRIGGER td_usuario_zona AFTER DELETE ON usuario_zona
FOR EACH ROW
BEGIN
	INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.zona_id, OLD.usuario);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS ti_zona;
DELIMITER $$
CREATE TRIGGER ti_zona AFTER INSERT ON zona
FOR EACH ROW
BEGIN
	INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
	VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cliente_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS tu_zona;
DELIMITER $$
CREATE TRIGGER tu_zona AFTER UPDATE ON zona
FOR EACH ROW
BEGIN
	INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
	VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cliente_id);
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS td_zona;
DELIMITER $$
CREATE TRIGGER td_zona AFTER DELETE ON zona
FOR EACH ROW
BEGIN
	INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
	VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cliente_id);
END$$
DELIMITER ;
			DROP TRIGGER IF EXISTS ti_banco;
			DELIMITER $$
			CREATE TRIGGER ti_banco AFTER INSERT ON banco
			FOR EACH ROW
			BEGIN
				INSERT INTO log_banco (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_banco;
			DELIMITER $$
			CREATE TRIGGER tu_banco AFTER UPDATE ON banco
			FOR EACH ROW
			BEGIN
				INSERT INTO log_banco (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_banco;
			DELIMITER $$
			CREATE TRIGGER td_banco AFTER DELETE ON banco
			FOR EACH ROW
			BEGIN
				INSERT INTO log_banco (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_cliente;
			DELIMITER $$
			CREATE TRIGGER ti_cliente AFTER INSERT ON cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.tipo_id, NEW.dni, NEW.cuit, NEW.condicionfiscal_id, NEW.genera_comision, NEW.sexo, NEW.apellido, NEW.nombre, NEW.fecha_nacimiento, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.celular, NEW.fax, NEW.email, NEW.observacion, NEW.usuario_id, NEW.lista_id, NEW.activo, NEW.recibir_curso, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_cliente;
			DELIMITER $$
			CREATE TRIGGER tu_cliente AFTER UPDATE ON cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.tipo_id, NEW.dni, NEW.cuit, NEW.condicionfiscal_id, NEW.genera_comision, NEW.sexo, NEW.apellido, NEW.nombre, NEW.fecha_nacimiento, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.celular, NEW.fax, NEW.email, NEW.observacion, NEW.usuario_id, NEW.lista_id, NEW.activo, NEW.recibir_curso, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_cliente;
			DELIMITER $$
			CREATE TRIGGER td_cliente AFTER DELETE ON cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente (log_fecha, log_operacion, id, tipo_id, dni, cuit, condicionfiscal_id, genera_comision, sexo, apellido, nombre, fecha_nacimiento, domicilio, localidad_id, telefono, celular, fax, email, observacion, usuario_id, lista_id, activo, recibir_curso, zona_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.tipo_id, OLD.dni, OLD.cuit, OLD.condicionfiscal_id, OLD.genera_comision, OLD.sexo, OLD.apellido, OLD.nombre, OLD.fecha_nacimiento, OLD.domicilio, OLD.localidad_id, OLD.telefono, OLD.celular, OLD.fax, OLD.email, OLD.observacion, OLD.usuario_id, OLD.lista_id, OLD.activo, OLD.recibir_curso, OLD.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_cliente_domicilio;
			DELIMITER $$
			CREATE TRIGGER ti_cliente_domicilio AFTER INSERT ON cliente_domicilio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.cliente_id, NEW.direccion, NEW.telefono, NEW.correo, NEW.observacion, NEW.localidad_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_cliente_domicilio;
			DELIMITER $$
			CREATE TRIGGER tu_cliente_domicilio AFTER UPDATE ON cliente_domicilio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.cliente_id, NEW.direccion, NEW.telefono, NEW.correo, NEW.observacion, NEW.localidad_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_cliente_domicilio;
			DELIMITER $$
			CREATE TRIGGER td_cliente_domicilio AFTER DELETE ON cliente_domicilio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_domicilio (log_fecha, log_operacion, id, cliente_id, direccion, telefono, correo, observacion, localidad_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.cliente_id, OLD.direccion, OLD.telefono, OLD.correo, OLD.observacion, OLD.localidad_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_cliente_seguimiento;
			DELIMITER $$
			CREATE TRIGGER ti_cliente_seguimiento AFTER INSERT ON cliente_seguimiento
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.cliente_id, NEW.fecha, NEW.hora, NEW.tipo_contacto_id, NEW.tipo_respuesta_id, NEW.comentario, NEW.prox_contac_fecha, NEW.prox_contac_hora, NEW.prox_contac_tiempo, NEW.prox_contact_coment, NEW.usuario, NEW.motivo_id, NEW.realizada);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_cliente_seguimiento;
			DELIMITER $$
			CREATE TRIGGER tu_cliente_seguimiento AFTER UPDATE ON cliente_seguimiento
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.cliente_id, NEW.fecha, NEW.hora, NEW.tipo_contacto_id, NEW.tipo_respuesta_id, NEW.comentario, NEW.prox_contac_fecha, NEW.prox_contac_hora, NEW.prox_contac_tiempo, NEW.prox_contact_coment, NEW.usuario, NEW.motivo_id, NEW.realizada);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_cliente_seguimiento;
			DELIMITER $$
			CREATE TRIGGER td_cliente_seguimiento AFTER DELETE ON cliente_seguimiento
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cliente_seguimiento (log_fecha, log_operacion, id, cliente_id, fecha, hora, tipo_contacto_id, tipo_respuesta_id, comentario, prox_contac_fecha, prox_contac_hora, prox_contac_tiempo, prox_contact_coment, usuario, motivo_id, realizada)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.cliente_id, OLD.fecha, OLD.hora, OLD.tipo_contacto_id, OLD.tipo_respuesta_id, OLD.comentario, OLD.prox_contac_fecha, OLD.prox_contac_hora, OLD.prox_contac_tiempo, OLD.prox_contact_coment, OLD.usuario, OLD.motivo_id, OLD.realizada);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_cobro;
			DELIMITER $$
			CREATE TRIGGER ti_cobro AFTER INSERT ON cobro
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.fecha_vto, NEW.devprod_id, NEW.observacion, NEW.usuario, NEW.nro_recibo, NEW.zona_id, NEW.archivo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_cobro;
			DELIMITER $$
			CREATE TRIGGER tu_cobro AFTER UPDATE ON cobro
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.fecha_vto, NEW.devprod_id, NEW.observacion, NEW.usuario, NEW.nro_recibo, NEW.zona_id, NEW.archivo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_cobro;
			DELIMITER $$
			CREATE TRIGGER td_cobro AFTER DELETE ON cobro
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, moneda_id, monto, tipo_id, banco_id, numero, fecha_vto, devprod_id, observacion, usuario, nro_recibo, zona_id, archivo)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.resumen_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.numero, OLD.fecha_vto, OLD.devprod_id, OLD.observacion, OLD.usuario, OLD.nro_recibo, OLD.zona_id, OLD.archivo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_cobro_resumen;
			DELIMITER $$
			CREATE TRIGGER ti_cobro_resumen AFTER INSERT ON cobro_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
				VALUES(NOW(), 'INSERT', NEW.cobro_id, NEW.resumen_id, NEW.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_cobro_resumen;
			DELIMITER $$
			CREATE TRIGGER tu_cobro_resumen AFTER UPDATE ON cobro_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
				VALUES(NOW(), 'UPDATE', NEW.cobro_id, NEW.resumen_id, NEW.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_cobro_resumen;
			DELIMITER $$
			CREATE TRIGGER td_cobro_resumen AFTER DELETE ON cobro_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_cobro_resumen (log_fecha, log_operacion, cobro_id, resumen_id, monto)
				VALUES(NOW(), 'DELETE', OLD.cobro_id, OLD.resumen_id, OLD.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_compra;
			DELIMITER $$
			CREATE TRIGGER ti_compra AFTER INSERT ON compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.cuenta_id, NEW.tipofactura_id, NEW.numero, NEW.fecha, NEW.proveedor_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.usuario, NEW.zona_id, NEW.remito_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_compra;
			DELIMITER $$
			CREATE TRIGGER tu_compra AFTER UPDATE ON compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.cuenta_id, NEW.tipofactura_id, NEW.numero, NEW.fecha, NEW.proveedor_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.usuario, NEW.zona_id, NEW.remito_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_compra;
			DELIMITER $$
			CREATE TRIGGER td_compra AFTER DELETE ON compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra (log_fecha, log_operacion, id, cuenta_id, tipofactura_id, numero, fecha, proveedor_id, moneda_id, observacion, pagado, usuario, zona_id, remito_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.cuenta_id, OLD.tipofactura_id, OLD.numero, OLD.fecha, OLD.proveedor_id, OLD.moneda_id, OLD.observacion, OLD.pagado, OLD.usuario, OLD.zona_id, OLD.remito_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_compra_lote;
			DELIMITER $$
			CREATE TRIGGER ti_compra_lote AFTER INSERT ON compra_lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.compra_id, NEW.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_compra_lote;
			DELIMITER $$
			CREATE TRIGGER tu_compra_lote AFTER UPDATE ON compra_lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.compra_id, NEW.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_compra_lote;
			DELIMITER $$
			CREATE TRIGGER td_compra_lote AFTER DELETE ON compra_lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_compra_lote (log_fecha, log_operacion, id, compra_id, lote_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.compra_id, OLD.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_condicion_fiscal;
			DELIMITER $$
			CREATE TRIGGER ti_condicion_fiscal AFTER INSERT ON condicion_fiscal
			FOR EACH ROW
			BEGIN
				INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cod_tipo_afip);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_condicion_fiscal;
			DELIMITER $$
			CREATE TRIGGER tu_condicion_fiscal AFTER UPDATE ON condicion_fiscal
			FOR EACH ROW
			BEGIN
				INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cod_tipo_afip);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_condicion_fiscal;
			DELIMITER $$
			CREATE TRIGGER td_condicion_fiscal AFTER DELETE ON condicion_fiscal
			FOR EACH ROW
			BEGIN
				INSERT INTO log_condicion_fiscal (log_fecha, log_operacion, id, nombre, cod_tipo_afip)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cod_tipo_afip);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_configuracion;
			DELIMITER $$
			CREATE TRIGGER ti_configuracion AFTER INSERT ON configuracion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.valor, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_configuracion;
			DELIMITER $$
			CREATE TRIGGER tu_configuracion AFTER UPDATE ON configuracion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.valor, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_configuracion;
			DELIMITER $$
			CREATE TRIGGER td_configuracion AFTER DELETE ON configuracion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_configuracion (log_fecha, log_operacion, id, valor, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.valor, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_curso;
			DELIMITER $$
			CREATE TRIGGER ti_curso AFTER INSERT ON curso
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.descripcion, NEW.fecha, NEW.hora, NEW.lugar, NEW.precio, NEW.mostrar_precio, NEW.logo, NEW.link_mapa, NEW.sitio_web, NEW.ini_insc, NEW.fin_insc, NEW.habilitado, NEW.permite_insc, NEW.foto1, NEW.foto2, NEW.foto3, NEW.foto4);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_curso;
			DELIMITER $$
			CREATE TRIGGER tu_curso AFTER UPDATE ON curso
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.descripcion, NEW.fecha, NEW.hora, NEW.lugar, NEW.precio, NEW.mostrar_precio, NEW.logo, NEW.link_mapa, NEW.sitio_web, NEW.ini_insc, NEW.fin_insc, NEW.habilitado, NEW.permite_insc, NEW.foto1, NEW.foto2, NEW.foto3, NEW.foto4);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_curso;
			DELIMITER $$
			CREATE TRIGGER td_curso AFTER DELETE ON curso
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso (log_fecha, log_operacion, id, nombre, descripcion, fecha, hora, lugar, precio, mostrar_precio, logo, link_mapa, sitio_web, ini_insc, fin_insc, habilitado, permite_insc, foto1, foto2, foto3, foto4)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.descripcion, OLD.fecha, OLD.hora, OLD.lugar, OLD.precio, OLD.mostrar_precio, OLD.logo, OLD.link_mapa, OLD.sitio_web, OLD.ini_insc, OLD.fin_insc, OLD.habilitado, OLD.permite_insc, OLD.foto1, OLD.foto2, OLD.foto3, OLD.foto4);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_curso_inscripcion;
			DELIMITER $$
			CREATE TRIGGER ti_curso_inscripcion AFTER INSERT ON curso_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.curso_id, NEW.cliente_id, NEW.nombre, NEW.correo, NEW.es_cliente, NEW.fecha, NEW.tipo_insc_id, NEW.comentario, NEW.asistio, NEW.pago_monto, NEW.mas_info, NEW.compro, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_curso_inscripcion;
			DELIMITER $$
			CREATE TRIGGER tu_curso_inscripcion AFTER UPDATE ON curso_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.curso_id, NEW.cliente_id, NEW.nombre, NEW.correo, NEW.es_cliente, NEW.fecha, NEW.tipo_insc_id, NEW.comentario, NEW.asistio, NEW.pago_monto, NEW.mas_info, NEW.compro, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_curso_inscripcion;
			DELIMITER $$
			CREATE TRIGGER td_curso_inscripcion AFTER DELETE ON curso_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_inscripcion (log_fecha, log_operacion, id, curso_id, cliente_id, nombre, correo, es_cliente, fecha, tipo_insc_id, comentario, asistio, pago_monto, mas_info, compro, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.curso_id, OLD.cliente_id, OLD.nombre, OLD.correo, OLD.es_cliente, OLD.fecha, OLD.tipo_insc_id, OLD.comentario, OLD.asistio, OLD.pago_monto, OLD.mas_info, OLD.compro, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_curso_mail_enviado;
			DELIMITER $$
			CREATE TRIGGER ti_curso_mail_enviado AFTER INSERT ON curso_mail_enviado
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.curso_id, NEW.fecha, NEW.e_mail, NEW.lo_vio, NEW.se_inscribio, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_curso_mail_enviado;
			DELIMITER $$
			CREATE TRIGGER tu_curso_mail_enviado AFTER UPDATE ON curso_mail_enviado
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.curso_id, NEW.fecha, NEW.e_mail, NEW.lo_vio, NEW.se_inscribio, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_curso_mail_enviado;
			DELIMITER $$
			CREATE TRIGGER td_curso_mail_enviado AFTER DELETE ON curso_mail_enviado
			FOR EACH ROW
			BEGIN
				INSERT INTO log_curso_mail_enviado (log_fecha, log_operacion, id, curso_id, fecha, e_mail, lo_vio, se_inscribio, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.curso_id, OLD.fecha, OLD.e_mail, OLD.lo_vio, OLD.se_inscribio, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_descuento_zona;
			DELIMITER $$
			CREATE TRIGGER ti_descuento_zona AFTER INSERT ON descuento_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.producto_id, NEW.grupoprod_id, NEW.porc_desc, NEW.precio_desc, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_descuento_zona;
			DELIMITER $$
			CREATE TRIGGER tu_descuento_zona AFTER UPDATE ON descuento_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.producto_id, NEW.grupoprod_id, NEW.porc_desc, NEW.precio_desc, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_descuento_zona;
			DELIMITER $$
			CREATE TRIGGER td_descuento_zona AFTER DELETE ON descuento_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_descuento_zona (log_fecha, log_operacion, id, producto_id, grupoprod_id, porc_desc, precio_desc, zona_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.producto_id, OLD.grupoprod_id, OLD.porc_desc, OLD.precio_desc, OLD.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_det_lis_precio;
			DELIMITER $$
			CREATE TRIGGER ti_det_lis_precio AFTER INSERT ON det_lis_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.lista_id, NEW.producto_id, NEW.grupoprod_id, NEW.aumento, NEW.descuento, NEW.precio);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_det_lis_precio;
			DELIMITER $$
			CREATE TRIGGER tu_det_lis_precio AFTER UPDATE ON det_lis_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.lista_id, NEW.producto_id, NEW.grupoprod_id, NEW.aumento, NEW.descuento, NEW.precio);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_det_lis_precio;
			DELIMITER $$
			CREATE TRIGGER td_det_lis_precio AFTER DELETE ON det_lis_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_det_lis_precio (log_fecha, log_operacion, id, lista_id, producto_id, grupoprod_id, aumento, descuento, precio)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.lista_id, OLD.producto_id, OLD.grupoprod_id, OLD.aumento, OLD.descuento, OLD.precio);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_detalle_compra;
			DELIMITER $$
			CREATE TRIGGER ti_detalle_compra AFTER INSERT ON detalle_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.compra_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.trazable, NEW.tiene_vto, NEW.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_detalle_compra;
			DELIMITER $$
			CREATE TRIGGER tu_detalle_compra AFTER UPDATE ON detalle_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.compra_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.trazable, NEW.tiene_vto, NEW.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_detalle_compra;
			DELIMITER $$
			CREATE TRIGGER td_detalle_compra AFTER DELETE ON detalle_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_compra (log_fecha, log_operacion, id, compra_id, producto_id, precio, cantidad, total, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, trazable, tiene_vto, lote_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.compra_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.iva, OLD.sub_total, OLD.exportado, OLD.usuario, OLD.trazable, OLD.tiene_vto, OLD.lote_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_detalle_pedido;
			DELIMITER $$
			CREATE TRIGGER ti_detalle_pedido AFTER INSERT ON detalle_pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.pedido_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.asignacion_lote);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_detalle_pedido;
			DELIMITER $$
			CREATE TRIGGER tu_detalle_pedido AFTER UPDATE ON detalle_pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.pedido_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.observacion, NEW.nro_lote, NEW.asignacion_lote);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_detalle_pedido;
			DELIMITER $$
			CREATE TRIGGER td_detalle_pedido AFTER DELETE ON detalle_pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_pedido (log_fecha, log_operacion, id, pedido_id, producto_id, precio, cantidad, total, observacion, nro_lote, asignacion_lote)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.pedido_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.observacion, OLD.nro_lote, OLD.asignacion_lote);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_detalle_presupuesto;
			DELIMITER $$
			CREATE TRIGGER ti_detalle_presupuesto AFTER INSERT ON detalle_presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.presupuesto_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.iva, NEW.descuento, NEW.sub_total);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_detalle_presupuesto;
			DELIMITER $$
			CREATE TRIGGER tu_detalle_presupuesto AFTER UPDATE ON detalle_presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.presupuesto_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.iva, NEW.descuento, NEW.sub_total);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_detalle_presupuesto;
			DELIMITER $$
			CREATE TRIGGER td_detalle_presupuesto AFTER DELETE ON detalle_presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_presupuesto (log_fecha, log_operacion, id, presupuesto_id, producto_id, cantidad, precio, total, iva, descuento, sub_total)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.presupuesto_id, OLD.producto_id, OLD.cantidad, OLD.precio, OLD.total, OLD.iva, OLD.descuento, OLD.sub_total);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_detalle_resumen;
			DELIMITER $$
			CREATE TRIGGER ti_detalle_resumen AFTER INSERT ON detalle_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.resumen_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.bonificados, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.lista_id, NEW.moneda_id, NEW.cant_vend_remito, NEW.lote_id, NEW.det_remito_id, NEW.descuento);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_detalle_resumen;
			DELIMITER $$
			CREATE TRIGGER tu_detalle_resumen AFTER UPDATE ON detalle_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.resumen_id, NEW.producto_id, NEW.precio, NEW.cantidad, NEW.total, NEW.bonificados, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.iva, NEW.sub_total, NEW.exportado, NEW.usuario, NEW.lista_id, NEW.moneda_id, NEW.cant_vend_remito, NEW.lote_id, NEW.det_remito_id, NEW.descuento);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_detalle_resumen;
			DELIMITER $$
			CREATE TRIGGER td_detalle_resumen AFTER DELETE ON detalle_resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_detalle_resumen (log_fecha, log_operacion, id, resumen_id, producto_id, precio, cantidad, total, bonificados, observacion, nro_lote, fecha_vto, iva, sub_total, exportado, usuario, lista_id, moneda_id, cant_vend_remito, lote_id, det_remito_id, descuento)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.resumen_id, OLD.producto_id, OLD.precio, OLD.cantidad, OLD.total, OLD.bonificados, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.iva, OLD.sub_total, OLD.exportado, OLD.usuario, OLD.lista_id, OLD.moneda_id, OLD.cant_vend_remito, OLD.lote_id, OLD.det_remito_id, OLD.descuento);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_dev_producto;
			DELIMITER $$
			CREATE TRIGGER ti_dev_producto AFTER INSERT ON dev_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.usuario, NEW.iva, NEW.afip_vto_cae, NEW.afip_estado, NEW.afip_cae, NEW.pto_vta, NEW.tipofactura_id, NEW.nro_factura, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.lote_id, NEW.zona_id, NEW.pago_comision_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_dev_producto;
			DELIMITER $$
			CREATE TRIGGER tu_dev_producto AFTER UPDATE ON dev_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.resumen_id, NEW.producto_id, NEW.cantidad, NEW.precio, NEW.total, NEW.observacion, NEW.nro_lote, NEW.fecha_vto, NEW.usuario, NEW.iva, NEW.afip_vto_cae, NEW.afip_estado, NEW.afip_cae, NEW.pto_vta, NEW.tipofactura_id, NEW.nro_factura, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.lote_id, NEW.zona_id, NEW.pago_comision_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_dev_producto;
			DELIMITER $$
			CREATE TRIGGER td_dev_producto AFTER DELETE ON dev_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_dev_producto (log_fecha, log_operacion, id, fecha, cliente_id, resumen_id, producto_id, cantidad, precio, total, observacion, nro_lote, fecha_vto, usuario, iva, afip_vto_cae, afip_estado, afip_cae, pto_vta, tipofactura_id, nro_factura, afip_envio, afip_respuesta, afip_mensaje, lote_id, zona_id, pago_comision_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.resumen_id, OLD.producto_id, OLD.cantidad, OLD.precio, OLD.total, OLD.observacion, OLD.nro_lote, OLD.fecha_vto, OLD.usuario, OLD.iva, OLD.afip_vto_cae, OLD.afip_estado, OLD.afip_cae, OLD.pto_vta, OLD.tipofactura_id, OLD.nro_factura, OLD.afip_envio, OLD.afip_respuesta, OLD.afip_mensaje, OLD.lote_id, OLD.zona_id, OLD.pago_comision_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_fact_compra;
			DELIMITER $$
			CREATE TRIGGER ti_fact_compra AFTER INSERT ON fact_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.proveedor_id, NEW.numero, NEW.tipofactura_id, NEW.fecha, NEW.moneda_id, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_fact_compra;
			DELIMITER $$
			CREATE TRIGGER tu_fact_compra AFTER UPDATE ON fact_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.proveedor_id, NEW.numero, NEW.tipofactura_id, NEW.fecha, NEW.moneda_id, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_fact_compra;
			DELIMITER $$
			CREATE TRIGGER td_fact_compra AFTER DELETE ON fact_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_fact_compra (log_fecha, log_operacion, id, proveedor_id, numero, tipofactura_id, fecha, moneda_id, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.proveedor_id, OLD.numero, OLD.tipofactura_id, OLD.fecha, OLD.moneda_id, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_grupoprod;
			DELIMITER $$
			CREATE TRIGGER ti_grupoprod AFTER INSERT ON grupoprod
			FOR EACH ROW
			BEGIN
				INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color, foto, foto_chica)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.color, NEW.foto, NEW.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_grupoprod;
			DELIMITER $$
			CREATE TRIGGER tu_grupoprod AFTER UPDATE ON grupoprod
			FOR EACH ROW
			BEGIN
				INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color, foto, foto_chica)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.color, NEW.foto, NEW.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_grupoprod;
			DELIMITER $$
			CREATE TRIGGER td_grupoprod AFTER DELETE ON grupoprod
			FOR EACH ROW
			BEGIN
				INSERT INTO log_grupoprod (log_fecha, log_operacion, id, nombre, color, foto, foto_chica)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.color, OLD.foto, OLD.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_lista_precio;
			DELIMITER $$
			CREATE TRIGGER ti_lista_precio AFTER INSERT ON lista_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.moneda_id, NEW.aumento, NEW.descuento, NEW.precio, NEW.defecto, NEW.activo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_lista_precio;
			DELIMITER $$
			CREATE TRIGGER tu_lista_precio AFTER UPDATE ON lista_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.moneda_id, NEW.aumento, NEW.descuento, NEW.precio, NEW.defecto, NEW.activo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_lista_precio;
			DELIMITER $$
			CREATE TRIGGER td_lista_precio AFTER DELETE ON lista_precio
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lista_precio (log_fecha, log_operacion, id, nombre, moneda_id, aumento, descuento, precio, defecto, activo)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.moneda_id, OLD.aumento, OLD.descuento, OLD.precio, OLD.defecto, OLD.activo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_localidad;
			DELIMITER $$
			CREATE TRIGGER ti_localidad AFTER INSERT ON localidad
			FOR EACH ROW
			BEGIN
				INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.provincia_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_localidad;
			DELIMITER $$
			CREATE TRIGGER tu_localidad AFTER UPDATE ON localidad
			FOR EACH ROW
			BEGIN
				INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.provincia_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_localidad;
			DELIMITER $$
			CREATE TRIGGER td_localidad AFTER DELETE ON localidad
			FOR EACH ROW
			BEGIN
				INSERT INTO log_localidad (log_fecha, log_operacion, id, nombre, provincia_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.provincia_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_lote;
			DELIMITER $$
			CREATE TRIGGER ti_lote AFTER INSERT ON lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id, NEW.activo, NEW.externo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_lote;
			DELIMITER $$
			CREATE TRIGGER tu_lote AFTER UPDATE ON lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.producto_id, NEW.nro_lote, NEW.stock, NEW.fecha_vto, NEW.compra_id, NEW.observacion, NEW.usuario_id, NEW.zona_id, NEW.activo, NEW.externo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_lote;
			DELIMITER $$
			CREATE TRIGGER td_lote AFTER DELETE ON lote
			FOR EACH ROW
			BEGIN
				INSERT INTO log_lote (log_fecha, log_operacion, id, producto_id, nro_lote, stock, fecha_vto, compra_id, observacion, usuario_id, zona_id, activo, externo)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.producto_id, OLD.nro_lote, OLD.stock, OLD.fecha_vto, OLD.compra_id, OLD.observacion, OLD.usuario_id, OLD.zona_id, OLD.activo, OLD.externo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_pago;
			DELIMITER $$
			CREATE TRIGGER ti_pago AFTER INSERT ON pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.proveedor_id, NEW.cuenta_id, NEW.compra_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_pago;
			DELIMITER $$
			CREATE TRIGGER tu_pago AFTER UPDATE ON pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.proveedor_id, NEW.cuenta_id, NEW.compra_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.numero, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_pago;
			DELIMITER $$
			CREATE TRIGGER td_pago AFTER DELETE ON pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago (log_fecha, log_operacion, id, fecha, proveedor_id, cuenta_id, compra_id, moneda_id, monto, tipo_id, banco_id, numero, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.proveedor_id, OLD.cuenta_id, OLD.compra_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.numero, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_pago_comision;
			DELIMITER $$
			CREATE TRIGGER ti_pago_comision AFTER INSERT ON pago_comision
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.revendedor_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.referencia, NEW.fecha_vto, NEW.observacion, NEW.nro_recibo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_pago_comision;
			DELIMITER $$
			CREATE TRIGGER tu_pago_comision AFTER UPDATE ON pago_comision
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.revendedor_id, NEW.moneda_id, NEW.monto, NEW.tipo_id, NEW.banco_id, NEW.referencia, NEW.fecha_vto, NEW.observacion, NEW.nro_recibo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_pago_comision;
			DELIMITER $$
			CREATE TRIGGER td_pago_comision AFTER DELETE ON pago_comision
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_comision (log_fecha, log_operacion, id, fecha, revendedor_id, moneda_id, monto, tipo_id, banco_id, referencia, fecha_vto, observacion, nro_recibo)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.revendedor_id, OLD.moneda_id, OLD.monto, OLD.tipo_id, OLD.banco_id, OLD.referencia, OLD.fecha_vto, OLD.observacion, OLD.nro_recibo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_pago_compra;
			DELIMITER $$
			CREATE TRIGGER ti_pago_compra AFTER INSERT ON pago_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
				VALUES(NOW(), 'INSERT', NEW.pago_id, NEW.compra_id, NEW.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_pago_compra;
			DELIMITER $$
			CREATE TRIGGER tu_pago_compra AFTER UPDATE ON pago_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
				VALUES(NOW(), 'UPDATE', NEW.pago_id, NEW.compra_id, NEW.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_pago_compra;
			DELIMITER $$
			CREATE TRIGGER td_pago_compra AFTER DELETE ON pago_compra
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pago_compra (log_fecha, log_operacion, pago_id, compra_id, monto)
				VALUES(NOW(), 'DELETE', OLD.pago_id, OLD.compra_id, OLD.monto);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_pedido;
			DELIMITER $$
			CREATE TRIGGER ti_pedido AFTER INSERT ON pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.observacion, NEW.vendido, NEW.fecha_venta, NEW.direccion_entrega, NEW.forma_envio, NEW.finalizado, NEW.cliente_domicilio_id, NEW.zona_id, NEW.usuario_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_pedido;
			DELIMITER $$
			CREATE TRIGGER tu_pedido AFTER UPDATE ON pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.observacion, NEW.vendido, NEW.fecha_venta, NEW.direccion_entrega, NEW.forma_envio, NEW.finalizado, NEW.cliente_domicilio_id, NEW.zona_id, NEW.usuario_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_pedido;
			DELIMITER $$
			CREATE TRIGGER td_pedido AFTER DELETE ON pedido
			FOR EACH ROW
			BEGIN
				INSERT INTO log_pedido (log_fecha, log_operacion, id, fecha, cliente_id, observacion, vendido, fecha_venta, direccion_entrega, forma_envio, finalizado, cliente_domicilio_id, zona_id, usuario_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.observacion, OLD.vendido, OLD.fecha_venta, OLD.direccion_entrega, OLD.forma_envio, OLD.finalizado, OLD.cliente_domicilio_id, OLD.zona_id, OLD.usuario_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_presupuesto;
			DELIMITER $$
			CREATE TRIGGER ti_presupuesto AFTER INSERT ON presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email, telefono)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.lista_id, NEW.descripcion, NEW.zona_id, NEW.email, NEW.telefono);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_presupuesto;
			DELIMITER $$
			CREATE TRIGGER tu_presupuesto AFTER UPDATE ON presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email, telefono)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.lista_id, NEW.descripcion, NEW.zona_id, NEW.email, NEW.telefono);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_presupuesto;
			DELIMITER $$
			CREATE TRIGGER td_presupuesto AFTER DELETE ON presupuesto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_presupuesto (log_fecha, log_operacion, id, fecha, lista_id, descripcion, zona_id, email, telefono)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.lista_id, OLD.descripcion, OLD.zona_id, OLD.email, OLD.telefono);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_producto;
			DELIMITER $$
			CREATE TRIGGER ti_producto AFTER INSERT ON producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.codigo, NEW.nombre, NEW.grupoprod_id, NEW.precio_vta, NEW.moneda_id, NEW.genera_comision, NEW.mueve_stock, NEW.minimo_stock, NEW.stock_actual, NEW.ctr_fact_grupo, NEW.orden_grupo, NEW.activo, NEW.grupo2, NEW.grupo3, NEW.lista_id, NEW.nombre_corto, NEW.foto, NEW.descripcion, NEW.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_producto;
			DELIMITER $$
			CREATE TRIGGER tu_producto AFTER UPDATE ON producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.codigo, NEW.nombre, NEW.grupoprod_id, NEW.precio_vta, NEW.moneda_id, NEW.genera_comision, NEW.mueve_stock, NEW.minimo_stock, NEW.stock_actual, NEW.ctr_fact_grupo, NEW.orden_grupo, NEW.activo, NEW.grupo2, NEW.grupo3, NEW.lista_id, NEW.nombre_corto, NEW.foto, NEW.descripcion, NEW.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_producto;
			DELIMITER $$
			CREATE TRIGGER td_producto AFTER DELETE ON producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_producto (log_fecha, log_operacion, id, codigo, nombre, grupoprod_id, precio_vta, moneda_id, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo, orden_grupo, activo, grupo2, grupo3, lista_id, nombre_corto, foto, descripcion, foto_chica)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.codigo, OLD.nombre, OLD.grupoprod_id, OLD.precio_vta, OLD.moneda_id, OLD.genera_comision, OLD.mueve_stock, OLD.minimo_stock, OLD.stock_actual, OLD.ctr_fact_grupo, OLD.orden_grupo, OLD.activo, OLD.grupo2, OLD.grupo3, OLD.lista_id, OLD.nombre_corto, OLD.foto, OLD.descripcion, OLD.foto_chica);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_promocion;
			DELIMITER $$
			CREATE TRIGGER ti_promocion AFTER INSERT ON promocion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion (log_fecha, log_operacion, id, nombre, descripcion, estado, fecha_ini, fecha_fin, tipo_id, min_cant, cant_regalo, porc_desc, aplica_neto, lista_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.descripcion, NEW.estado, NEW.fecha_ini, NEW.fecha_fin, NEW.tipo_id, NEW.min_cant, NEW.cant_regalo, NEW.porc_desc, NEW.aplica_neto, NEW.lista_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_promocion;
			DELIMITER $$
			CREATE TRIGGER tu_promocion AFTER UPDATE ON promocion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion (log_fecha, log_operacion, id, nombre, descripcion, estado, fecha_ini, fecha_fin, tipo_id, min_cant, cant_regalo, porc_desc, aplica_neto, lista_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.descripcion, NEW.estado, NEW.fecha_ini, NEW.fecha_fin, NEW.tipo_id, NEW.min_cant, NEW.cant_regalo, NEW.porc_desc, NEW.aplica_neto, NEW.lista_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_promocion;
			DELIMITER $$
			CREATE TRIGGER td_promocion AFTER DELETE ON promocion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion (log_fecha, log_operacion, id, nombre, descripcion, estado, fecha_ini, fecha_fin, tipo_id, min_cant, cant_regalo, porc_desc, aplica_neto, lista_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.descripcion, OLD.estado, OLD.fecha_ini, OLD.fecha_fin, OLD.tipo_id, OLD.min_cant, OLD.cant_regalo, OLD.porc_desc, OLD.aplica_neto, OLD.lista_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_promocion_producto;
			DELIMITER $$
			CREATE TRIGGER ti_promocion_producto AFTER INSERT ON promocion_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_producto (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.promocion_id, NEW.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_promocion_producto;
			DELIMITER $$
			CREATE TRIGGER tu_promocion_producto AFTER UPDATE ON promocion_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_producto (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.promocion_id, NEW.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_promocion_producto;
			DELIMITER $$
			CREATE TRIGGER td_promocion_producto AFTER DELETE ON promocion_producto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_producto (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.promocion_id, OLD.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_promocion_regalo;
			DELIMITER $$
			CREATE TRIGGER ti_promocion_regalo AFTER INSERT ON promocion_regalo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_regalo (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.promocion_id, NEW.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_promocion_regalo;
			DELIMITER $$
			CREATE TRIGGER tu_promocion_regalo AFTER UPDATE ON promocion_regalo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_regalo (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.promocion_id, NEW.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_promocion_regalo;
			DELIMITER $$
			CREATE TRIGGER td_promocion_regalo AFTER DELETE ON promocion_regalo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_promocion_regalo (log_fecha, log_operacion, id, promocion_id, producto_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.promocion_id, OLD.producto_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_proveedor;
			DELIMITER $$
			CREATE TRIGGER ti_proveedor AFTER INSERT ON proveedor
			FOR EACH ROW
			BEGIN
				INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.cuit, NEW.condicionfiscal_id, NEW.razon_social, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.email, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_proveedor;
			DELIMITER $$
			CREATE TRIGGER tu_proveedor AFTER UPDATE ON proveedor
			FOR EACH ROW
			BEGIN
				INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.cuit, NEW.condicionfiscal_id, NEW.razon_social, NEW.domicilio, NEW.localidad_id, NEW.telefono, NEW.email, NEW.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_proveedor;
			DELIMITER $$
			CREATE TRIGGER td_proveedor AFTER DELETE ON proveedor
			FOR EACH ROW
			BEGIN
				INSERT INTO log_proveedor (log_fecha, log_operacion, id, cuit, condicionfiscal_id, razon_social, domicilio, localidad_id, telefono, email, observacion)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.cuit, OLD.condicionfiscal_id, OLD.razon_social, OLD.domicilio, OLD.localidad_id, OLD.telefono, OLD.email, OLD.observacion);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_provincia;
			DELIMITER $$
			CREATE TRIGGER ti_provincia AFTER INSERT ON provincia
			FOR EACH ROW
			BEGIN
				INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_provincia;
			DELIMITER $$
			CREATE TRIGGER tu_provincia AFTER UPDATE ON provincia
			FOR EACH ROW
			BEGIN
				INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_provincia;
			DELIMITER $$
			CREATE TRIGGER td_provincia AFTER DELETE ON provincia
			FOR EACH ROW
			BEGIN
				INSERT INTO log_provincia (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_resumen;
			DELIMITER $$
			CREATE TRIGGER ti_resumen AFTER INSERT ON resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.fecha, NEW.cliente_id, NEW.lista_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.fecha_pagado, NEW.pedido_id, NEW.nro_factura, NEW.tipofactura_id, NEW.usuario, NEW.afip_estado, NEW.afip_cae, NEW.afip_nro_comp, NEW.afip_vto_cae, NEW.pto_vta, NEW.tipo_venta_id, NEW.remito_id, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.pago_comision_id, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_resumen;
			DELIMITER $$
			CREATE TRIGGER tu_resumen AFTER UPDATE ON resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.fecha, NEW.cliente_id, NEW.lista_id, NEW.moneda_id, NEW.observacion, NEW.pagado, NEW.fecha_pagado, NEW.pedido_id, NEW.nro_factura, NEW.tipofactura_id, NEW.usuario, NEW.afip_estado, NEW.afip_cae, NEW.afip_nro_comp, NEW.afip_vto_cae, NEW.pto_vta, NEW.tipo_venta_id, NEW.remito_id, NEW.afip_envio, NEW.afip_respuesta, NEW.afip_mensaje, NEW.pago_comision_id, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_resumen;
			DELIMITER $$
			CREATE TRIGGER td_resumen AFTER DELETE ON resumen
			FOR EACH ROW
			BEGIN
				INSERT INTO log_resumen (log_fecha, log_operacion, id, fecha, cliente_id, lista_id, moneda_id, observacion, pagado, fecha_pagado, pedido_id, nro_factura, tipofactura_id, usuario, afip_estado, afip_cae, afip_nro_comp, afip_vto_cae, pto_vta, tipo_venta_id, remito_id, afip_envio, afip_respuesta, afip_mensaje, pago_comision_id, zona_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.fecha, OLD.cliente_id, OLD.lista_id, OLD.moneda_id, OLD.observacion, OLD.pagado, OLD.fecha_pagado, OLD.pedido_id, OLD.nro_factura, OLD.tipofactura_id, OLD.usuario, OLD.afip_estado, OLD.afip_cae, OLD.afip_nro_comp, OLD.afip_vto_cae, OLD.pto_vta, OLD.tipo_venta_id, OLD.remito_id, OLD.afip_envio, OLD.afip_respuesta, OLD.afip_mensaje, OLD.pago_comision_id, OLD.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_forgot_password;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_forgot_password AFTER INSERT ON sf_guard_forgot_password
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.user_id, NEW.unique_key, NEW.expires_at, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_forgot_password;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_forgot_password AFTER UPDATE ON sf_guard_forgot_password
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.user_id, NEW.unique_key, NEW.expires_at, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_forgot_password;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_forgot_password AFTER DELETE ON sf_guard_forgot_password
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_forgot_password (log_fecha, log_operacion, id, user_id, unique_key, expires_at, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.user_id, OLD.unique_key, OLD.expires_at, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_group;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_group AFTER INSERT ON sf_guard_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_group;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_group AFTER UPDATE ON sf_guard_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_group;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_group AFTER DELETE ON sf_guard_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group (log_fecha, log_operacion, id, name, description, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.name, OLD.description, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_group_permission;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_group_permission AFTER INSERT ON sf_guard_group_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.group_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_group_permission;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_group_permission AFTER UPDATE ON sf_guard_group_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.group_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_group_permission;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_group_permission AFTER DELETE ON sf_guard_group_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_group_permission (log_fecha, log_operacion, group_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.group_id, OLD.permission_id, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_permission;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_permission AFTER INSERT ON sf_guard_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at, NEW.padre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_permission;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_permission AFTER UPDATE ON sf_guard_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.name, NEW.description, NEW.created_at, NEW.updated_at, NEW.padre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_permission;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_permission AFTER DELETE ON sf_guard_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_permission (log_fecha, log_operacion, id, name, description, created_at, updated_at, padre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.name, OLD.description, OLD.created_at, OLD.updated_at, OLD.padre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_remember_key;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_remember_key AFTER INSERT ON sf_guard_remember_key
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.user_id, NEW.remember_key, NEW.ip_address, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_remember_key;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_remember_key AFTER UPDATE ON sf_guard_remember_key
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.user_id, NEW.remember_key, NEW.ip_address, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_remember_key;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_remember_key AFTER DELETE ON sf_guard_remember_key
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_remember_key (log_fecha, log_operacion, id, user_id, remember_key, ip_address, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.user_id, OLD.remember_key, OLD.ip_address, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_user;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_user AFTER INSERT ON sf_guard_user
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.first_name, NEW.last_name, NEW.email_address, NEW.username, NEW.algorithm, NEW.salt, NEW.password, NEW.is_active, NEW.is_super_admin, NEW.last_login, NEW.created_at, NEW.updated_at, NEW.es_cliente, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_user;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_user AFTER UPDATE ON sf_guard_user
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.first_name, NEW.last_name, NEW.email_address, NEW.username, NEW.algorithm, NEW.salt, NEW.password, NEW.is_active, NEW.is_super_admin, NEW.last_login, NEW.created_at, NEW.updated_at, NEW.es_cliente, NEW.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_user;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_user AFTER DELETE ON sf_guard_user
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user (log_fecha, log_operacion, id, first_name, last_name, email_address, username, algorithm, salt, password, is_active, is_super_admin, last_login, created_at, updated_at, es_cliente, zona_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.first_name, OLD.last_name, OLD.email_address, OLD.username, OLD.algorithm, OLD.salt, OLD.password, OLD.is_active, OLD.is_super_admin, OLD.last_login, OLD.created_at, OLD.updated_at, OLD.es_cliente, OLD.zona_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_user_group;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_user_group AFTER INSERT ON sf_guard_user_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.user_id, NEW.group_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_user_group;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_user_group AFTER UPDATE ON sf_guard_user_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.user_id, NEW.group_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_user_group;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_user_group AFTER DELETE ON sf_guard_user_group
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_group (log_fecha, log_operacion, user_id, group_id, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.user_id, OLD.group_id, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_sf_guard_user_permission;
			DELIMITER $$
			CREATE TRIGGER ti_sf_guard_user_permission AFTER INSERT ON sf_guard_user_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'INSERT', NEW.user_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_sf_guard_user_permission;
			DELIMITER $$
			CREATE TRIGGER tu_sf_guard_user_permission AFTER UPDATE ON sf_guard_user_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'UPDATE', NEW.user_id, NEW.permission_id, NEW.created_at, NEW.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_sf_guard_user_permission;
			DELIMITER $$
			CREATE TRIGGER td_sf_guard_user_permission AFTER DELETE ON sf_guard_user_permission
			FOR EACH ROW
			BEGIN
				INSERT INTO log_sf_guard_user_permission (log_fecha, log_operacion, user_id, permission_id, created_at, updated_at)
				VALUES(NOW(), 'DELETE', OLD.user_id, OLD.permission_id, OLD.created_at, OLD.updated_at);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_cliente;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_cliente AFTER INSERT ON tipo_cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_cliente;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_cliente AFTER UPDATE ON tipo_cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_cliente;
			DELIMITER $$
			CREATE TRIGGER td_tipo_cliente AFTER DELETE ON tipo_cliente
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cliente (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_cobro_pago;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_cobro_pago AFTER INSERT ON tipo_cobro_pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_cobro_pago;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_cobro_pago AFTER UPDATE ON tipo_cobro_pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_cobro_pago;
			DELIMITER $$
			CREATE TRIGGER td_tipo_cobro_pago AFTER DELETE ON tipo_cobro_pago
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_cobro_pago (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_contacto;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_contacto AFTER INSERT ON tipo_contacto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_contacto;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_contacto AFTER UPDATE ON tipo_contacto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_contacto;
			DELIMITER $$
			CREATE TRIGGER td_tipo_contacto AFTER DELETE ON tipo_contacto
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_contacto (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_factura;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_factura AFTER INSERT ON tipo_factura
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cod_tipo_afip, NEW.letra, NEW.id_fact_cancela, NEW.nombre_corto, NEW.modelo_impresion, NEW.cond_fiscales);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_factura;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_factura AFTER UPDATE ON tipo_factura
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cod_tipo_afip, NEW.letra, NEW.id_fact_cancela, NEW.nombre_corto, NEW.modelo_impresion, NEW.cond_fiscales);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_factura;
			DELIMITER $$
			CREATE TRIGGER td_tipo_factura AFTER DELETE ON tipo_factura
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_factura (log_fecha, log_operacion, id, nombre, cod_tipo_afip, letra, id_fact_cancela, nombre_corto, modelo_impresion, cond_fiscales)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cod_tipo_afip, OLD.letra, OLD.id_fact_cancela, OLD.nombre_corto, OLD.modelo_impresion, OLD.cond_fiscales);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_inscripcion;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_inscripcion AFTER INSERT ON tipo_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_inscripcion;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_inscripcion AFTER UPDATE ON tipo_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_inscripcion;
			DELIMITER $$
			CREATE TRIGGER td_tipo_inscripcion AFTER DELETE ON tipo_inscripcion
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_inscripcion (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_moneda;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_moneda AFTER INSERT ON tipo_moneda
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.simbolo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_moneda;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_moneda AFTER UPDATE ON tipo_moneda
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.simbolo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_moneda;
			DELIMITER $$
			CREATE TRIGGER td_tipo_moneda AFTER DELETE ON tipo_moneda
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_moneda (log_fecha, log_operacion, id, nombre, simbolo)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.simbolo);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_motivo;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_motivo AFTER INSERT ON tipo_motivo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_motivo;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_motivo AFTER UPDATE ON tipo_motivo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_motivo;
			DELIMITER $$
			CREATE TRIGGER td_tipo_motivo AFTER DELETE ON tipo_motivo
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_motivo (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_respuesta;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_respuesta AFTER INSERT ON tipo_respuesta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_respuesta;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_respuesta AFTER UPDATE ON tipo_respuesta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_respuesta;
			DELIMITER $$
			CREATE TRIGGER td_tipo_respuesta AFTER DELETE ON tipo_respuesta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_respuesta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_tiempo_contac;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_tiempo_contac AFTER INSERT ON tipo_tiempo_contac
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_tiempo_contac;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_tiempo_contac AFTER UPDATE ON tipo_tiempo_contac
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_tiempo_contac;
			DELIMITER $$
			CREATE TRIGGER td_tipo_tiempo_contac AFTER DELETE ON tipo_tiempo_contac
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_tiempo_contac (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_tipo_venta;
			DELIMITER $$
			CREATE TRIGGER ti_tipo_venta AFTER INSERT ON tipo_venta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_tipo_venta;
			DELIMITER $$
			CREATE TRIGGER tu_tipo_venta AFTER UPDATE ON tipo_venta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_tipo_venta;
			DELIMITER $$
			CREATE TRIGGER td_tipo_venta AFTER DELETE ON tipo_venta
			FOR EACH ROW
			BEGIN
				INSERT INTO log_tipo_venta (log_fecha, log_operacion, id, nombre)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_usuario_zona;
			DELIMITER $$
			CREATE TRIGGER ti_usuario_zona AFTER INSERT ON usuario_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.zona_id, NEW.usuario);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_usuario_zona;
			DELIMITER $$
			CREATE TRIGGER tu_usuario_zona AFTER UPDATE ON usuario_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.zona_id, NEW.usuario);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_usuario_zona;
			DELIMITER $$
			CREATE TRIGGER td_usuario_zona AFTER DELETE ON usuario_zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_usuario_zona (log_fecha, log_operacion, id, zona_id, usuario)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.zona_id, OLD.usuario);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS ti_zona;
			DELIMITER $$
			CREATE TRIGGER ti_zona AFTER INSERT ON zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
				VALUES(NOW(), 'INSERT', NEW.id, NEW.nombre, NEW.cliente_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS tu_zona;
			DELIMITER $$
			CREATE TRIGGER tu_zona AFTER UPDATE ON zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
				VALUES(NOW(), 'UPDATE', NEW.id, NEW.nombre, NEW.cliente_id);
			END$$
			DELIMITER ;
		

			DROP TRIGGER IF EXISTS td_zona;
			DELIMITER $$
			CREATE TRIGGER td_zona AFTER DELETE ON zona
			FOR EACH ROW
			BEGIN
				INSERT INTO log_zona (log_fecha, log_operacion, id, nombre, cliente_id)
				VALUES(NOW(), 'DELETE', OLD.id, OLD.nombre, OLD.cliente_id);
			END$$
			DELIMITER ;
		
