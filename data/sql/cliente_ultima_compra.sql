CREATE VIEW cliente_ultima_compra AS select 
	id, 
	apellido, 
	nombre,
	telefono, 
	email, 
	celular,
	(select max(fecha) from resumen where cliente_id = cliente.id) as fecha
from cliente ;