drop view control_stock;
create view control_stock as
select 
	l.id AS id,
	l.producto_id AS producto_id,
	p.nombre AS nombre,
	p.grupoprod_id AS grupoprod_id,
	l.nro_lote AS nro_lote,
	l.zona_id AS zona_id,
	0 AS comprados,
	0 AS vendidos,
	0 AS cant_dev,
	l.stock AS stock_guardado,
	p.minimo_stock AS minimo_stock,
	(
		SELECT 
			case when max(r1.fecha) > COALESCE(
																	(
																	select max(dp1.fecha) 
																	FROM dev_producto dp1 
																	where dp1.producto_id = l.producto_id 
																	and dp1.zona_id = l.zona_id
																	and dp1.nro_lote = l.nro_lote), '1900-01-01'
																	)
				then max(r1.fecha) 
				else (select max(dp1.fecha) FROM dev_producto dp1 where dp1.producto_id = l.producto_id and dp1.nro_lote = l.nro_lote)
			end
		from resumen r1 
			join detalle_resumen dr on r1.id = dr.resumen_id			
		where dr.producto_id = l.producto_id and dr.nro_lote = l.nro_lote and r1.zona_id = l.zona_id
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
	and exists(select 1 from detalle_compra dc where dc.nro_lote = l.nro_lote and dc.producto_id = l.producto_id);