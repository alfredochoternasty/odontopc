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
		where dc.nro_lote = l.nro_lote and l.zona_id = compra.zona_id and dc.nro_lote not like 'er%'
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
	and not(l.nro_lote in (select lotes_romi.nro_lote from lotes_romi))
	and not(l.nro_lote like 'er%') 
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