delete from traza2;
delete from compra2;
ALTER TABLE detalle_compra	ADD COLUMN trazable TINYINT NOT NULL DEFAULT '0';
DROP VIEW producto_traza;  
CREATE VIEW producto_traza 
AS 
select
	dr.id,
	p.id as producto_id,
	p.codigo,
	REPLACE(dc.nro_lote, 'T ', '') as nro_lote,
	dc.fecha_vto, 
	r.id as nro_venta,
	r.fecha as fecha_venta,
	c.id as cliente_id,
	com.fecha as fecha_compra,
	prov.id as proveedor_id,
	com.numero,
	dr.cantidad as cant_vendida,
	dc.cantidad as cant_comprada
from 
	producto p
		join detalle_resumen dr on p.id = dr.producto_id
		join resumen r on dr.resumen_id = r.id
		join cliente c on r.cliente_id = c.id
		join detalle_compra dc on p.id = dc.producto_id and dr.nro_lote = dc.nro_lote
		join compra com on dc.compra_id = com.id
		join proveedor prov on com.proveedor_id = prov.id
where dc.trazable = 1;

DROP VIEW cliente_ultima_compra;
CREATE VIEW cliente_ultima_compra  AS  
select 
	max(r.id) AS id,
	c.id AS cliente_id,
	c.apellido AS apellido,
	c.nombre AS nombre,
	max(r.fecha) AS fecha, 
	c.telefono AS telefono,
	c.celular AS celular,
	c.email AS email
from 
	cliente c 
		join resumen r on c.id = r.cliente_id 
group by 
	c.id,
	c.apellido,
	c.nombre ;
	
update detalle_compra set trazable = 1 where nro_lote like 'T%' or exists(select '' from sf_guard_group where name = 'Blanco')