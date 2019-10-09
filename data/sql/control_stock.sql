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
		where dc.nro_lote = l.nro_lote and l.zona_id = compra.zona_id
	) AS comprados,
	(
		select (sum(lv.cantidad) + sum(lv.bonificados)) - coalesce(sum(lv.cant_dev),0) 
		from listado_ventas lv 
		where 
			lv.nro_lote = l.nro_lote 
			and lv.producto_id = l.producto_id
			and lv.zona_id = l.zona_id 
			and (
						(isnull(lv.det_remito_id) and lv.zona_id = 1) 
						or (lv.det_remito_id is not null and lv.zona_id <> 1)
					)
	) AS vendidos,
	l.stock AS stock_guardado,
	p.minimo_stock AS minimo_stock,
	(
		SELECT 
			case when max(r.fecha) > max(d.fecha) 
				then max(r.fecha) 
				else max(d.fecha)
			end
		from resumen r 
			join detalle_resumen dr on r.id = dr.resumen_id,
			dev_producto d
		where dr.producto_id = l.producto_id
				and dr.nro_lote = l.nro_lote
				and d.producto_id = l.producto_id
				and d.nro_lote = l.nro_lote
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