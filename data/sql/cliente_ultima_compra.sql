DROP VIEW cliente_ultima_compra;
CREATE VIEW cliente_ultima_compra AS select 
	id, 
	zona_id,
	apellido, 
	nombre,
	telefono, 
	email, 
	celular,
	(select max(r1.fecha) from resumen r1 where r1.cliente_id = c.id) as fecha,
  (
    select max(r2.id) 
    from resumen r2
    where r2.cliente_id = c.id 
      and r2.fecha = (
        select max(r3.fecha) from resumen r3 where r3.cliente_id = c.id
      )
  ) as resumen_id
from cliente c;