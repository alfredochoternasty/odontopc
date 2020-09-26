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
	resumen.tipofactura_id,
	detalle_resumen.det_remito_id
from 
	resumen 
		join detalle_resumen on resumen.id = detalle_resumen.resumen_id
		join producto on producto.id = detalle_resumen.producto_id
where
	resumen.tipofactura_id <> 4
UNION
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
	resumen.tipofactura_id,
	null
from 
	dev_producto
		join producto on dev_producto.producto_id = producto.id
		join resumen on dev_producto.resumen_id = resumen.id;
where
	resumen.tipofactura_id <> 4;
	
update producto set grupoprod_id = 26 where grupoprod_id in (8, 9, 10);
update det_lis_precio set grupoprod_id = 26 where grupoprod_id in (8, 9, 10);
update descuento_zona set grupoprod_id = 26 where grupoprod_id in (8, 9, 10);

DELETE FROM descuento_zona WHERE (id = '3');
DELETE FROM descuento_zona WHERE (id = '4');
DELETE FROM descuento_zona WHERE (id = '30');
DELETE FROM descuento_zona WHERE (id = '16');
DELETE FROM descuento_zona WHERE (id = '17');
DELETE FROM descuento_zona WHERE (id = '31');

DELETE FROM det_lis_precio WHERE (id = '3');
DELETE FROM det_lis_precio WHERE (id = '4');
DELETE FROM det_lis_precio WHERE (id = '15');
DELETE FROM det_lis_precio WHERE (id = '16');
DELETE FROM det_lis_precio WHERE (id = '62');
DELETE FROM det_lis_precio WHERE (id = '50');
DELETE FROM det_lis_precio WHERE (id = '61');
DELETE FROM det_lis_precio WHERE (id = '59');
DELETE FROM det_lis_precio WHERE (id = '97');
DELETE FROM det_lis_precio WHERE (id = '96');
DELETE FROM det_lis_precio WHERE (id = '104');
DELETE FROM det_lis_precio WHERE (id = '105');
DELETE FROM det_lis_precio WHERE (id = '151');
DELETE FROM det_lis_precio WHERE (id = '150');
DELETE FROM det_lis_precio WHERE (id = '213');
DELETE FROM det_lis_precio WHERE (id = '214');
DELETE FROM det_lis_precio WHERE (id = '217');
DELETE FROM det_lis_precio WHERE (id = '218');
DELETE FROM det_lis_precio WHERE (id = '261');
DELETE FROM det_lis_precio WHERE (id = '260');
DELETE FROM det_lis_precio WHERE (id = '275');
DELETE FROM det_lis_precio WHERE (id = '276');
DELETE FROM det_lis_precio WHERE (id = '287');
DELETE FROM det_lis_precio WHERE (id = '288');
DELETE FROM det_lis_precio WHERE (id = '291');
DELETE FROM det_lis_precio WHERE (id = '292');
DELETE FROM det_lis_precio WHERE (id = '330');
DELETE FROM det_lis_precio WHERE (id = '329');
DELETE FROM det_lis_precio WHERE (id = '355');
DELETE FROM det_lis_precio WHERE (id = '354');
DELETE FROM det_lis_precio WHERE (id = '364');
DELETE FROM det_lis_precio WHERE (id = '362');
DELETE FROM det_lis_precio WHERE (id = '372');
DELETE FROM det_lis_precio WHERE (id = '371');
DELETE FROM det_lis_precio WHERE (id = '390');
DELETE FROM det_lis_precio WHERE (id = '392');
DELETE FROM det_lis_precio WHERE (id = '398');
DELETE FROM det_lis_precio WHERE (id = '399');
DELETE FROM det_lis_precio WHERE (id = '417');
DELETE FROM det_lis_precio WHERE (id = '416');
DELETE FROM det_lis_precio WHERE (id = '458');
DELETE FROM det_lis_precio WHERE (id = '460');

delete from grupoprod where id in (8,9,10);

UPDATE `ventas`.`producto` SET `orden_grupo` = '10' WHERE (`id` = '156');
UPDATE `ventas`.`producto` SET `orden_grupo` = '20' WHERE (`id` = '155');
UPDATE `ventas`.`producto` SET `orden_grupo` = '30' WHERE (`id` = '150');
UPDATE `ventas`.`producto` SET `orden_grupo` = '40' WHERE (`id` = '151');
UPDATE `ventas`.`producto` SET `orden_grupo` = '50' WHERE (`id` = '152');
UPDATE `ventas`.`producto` SET `orden_grupo` = '60' WHERE (`id` = '153');
UPDATE `ventas`.`producto` SET `orden_grupo` = '100' WHERE (`id` = '157');
UPDATE `ventas`.`producto` SET `orden_grupo` = '120' WHERE (`id` = '158');
UPDATE `ventas`.`producto` SET `orden_grupo` = '130' WHERE (`id` = '159');
UPDATE `ventas`.`producto` SET `orden_grupo` = '140' WHERE (`id` = '160');
UPDATE `ventas`.`producto` SET `orden_grupo` = '150' WHERE (`id` = '161');
UPDATE `ventas`.`producto` SET `orden_grupo` = '160' WHERE (`id` = '162');
UPDATE `ventas`.`producto` SET `orden_grupo` = '200' WHERE (`id` = '163');
UPDATE `ventas`.`producto` SET `orden_grupo` = '220' WHERE (`id` = '164');
UPDATE `ventas`.`producto` SET `orden_grupo` = '230' WHERE (`id` = '165');
UPDATE `ventas`.`producto` SET `orden_grupo` = '240' WHERE (`id` = '166');
UPDATE `ventas`.`producto` SET `orden_grupo` = '250' WHERE (`id` = '168');
UPDATE `ventas`.`producto` SET `orden_grupo` = '260' WHERE (`id` = '167');
