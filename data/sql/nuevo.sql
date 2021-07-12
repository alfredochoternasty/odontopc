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

insert into descuento_zona (zona_id, cliente_id, porc_desc)
select zona_id, id, 10 from cliente where id in (808, 803, 810, 806, 793, 708, 791, 792, 813, 800, 788, 802, 657, 811, 805, 777, 675, 812, 797, 769, 655, 736, 801, 782, 770, 790, 798, 840, 784, 796, 671, 804, 785, 789, 756, 786, 724, 719, 746, 722, 698, 781, 767);

insert into descuento_zona (zona_id, cliente_id, porc_desc)
select zona_id, id, 0 from cliente where id in (795, 783, 778, 709, 779, 787, 671, 682, 780);

CREATE TEMPORARY TABLE fecha_alta_clientes
select id, log_fecha from log_cliente where log_operacion = 'INSERT';

update cliente 
set fecha_alta = (select log_fecha from fecha_alta_clientes where fecha_alta_clientes.id = cliente.id) 
where fecha_alta is null;

update cliente 
set modo_alta = 'sistema'
where modo_alta is null or modo_alta = '';