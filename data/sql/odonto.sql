update localidad set nombre = upper(nombre)
update detalle_resumen set producto_id = 1 where producto_id = 73
delete from producto where id = 73

insert into cobro_resumen
select id, resumen_id, monto from cobro where resumen_id <> 0


select 
  -- count(*), 
  -- resumen_id, 
  fecha, 
  cliente_id, 
  moneda_id, 
  sum(monto), 
  tipo_id, 
  banco_id, 
  numero, 
  fecha_vto, 
  observacion 
from cobro
group by
  resumen_id, fecha, cliente_id, moneda_id, tipo_id, banco_id, numero, fecha_vto, observacion