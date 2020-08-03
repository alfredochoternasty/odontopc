create view lista_precio_detalle as 
select
	dlp.id,
	dlp.lista_id,
	lp.nombre,
	lp.moneda_id,
	dlp.grupoprod_id as grupo_id,
	g_p.id as producto_grupo_id,
	dlp.producto_id as producto_id,
	case when dlp.aumento is not null
		then g_p.precio_vta + (g_p.precio_vta/(dlp.aumento*100))
		else case when dlp.descuento is not null
					then g_p.precio_vta - (g_p.precio_vta / (dlp.descuento * 100))
					else case when dlp.precio is not null
								then dlp.precio
								else 0
							end
				end
	end as precio
from
	lista_precio lp
		join det_lis_precio dlp on lp.id = dlp.lista_id
		left outer join grupoprod gp on dlp.grupoprod_id = gp.id
		left outer join producto g_p on gp.id = g_p.grupoprod_id
		left outer join producto p on dlp.producto_id = p.id
where 
	lp.activo = 1;