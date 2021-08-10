ALTER TABLE pago 
ADD COLUMN comprobante VARCHAR(255) NULL AFTER observacion;

CREATE TABLE lote_ajuste (
  id INT NOT NULL AUTO_INCREMENT,
  fecha DATE NULL,
  producto_id INT NULL,
  nro_lote VARCHAR(45) NULL,
  zona_id INT NULL,
  cantidad INT NULL,
  observacion VARCHAR(255) NULL,
  usuario_id INT NULL,
  PRIMARY KEY (id));

insert into lote_ajuste(fecha, producto_id, nro_lote, zona_id, cantidad, observacion, usuario_id)values 
(current_date, 37, '1201201500001/18', 3, 1, 'ajuste por recuento de stock', 1),
(current_date, 92, '4109300014001/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 311, '5301300140001/20', 3, -4, 'ajuste por recuento de stock', 1),
(current_date, 310, '5301100210001/20', 3, 2, 'ajuste por recuento de stock', 1),
(current_date, 327, '5201300140001/20', 3, 4, 'ajuste por recuento de stock', 1),
(current_date, 313, '5201100210001/20', 3, -2, 'ajuste por recuento de stock', 1),
(current_date, 105, '1004500350001/18', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 251, '3903750300003/19', 3, -5, 'ajuste por recuento de stock', 1),
(current_date, 155, '0103500850002B/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 150, '0103501000001C/19', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 263, '2203501000002D/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 264, '2203501150002D/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 265, '2203501300002B/19', 3, -2, 'ajuste por recuento de stock', 1),
(current_date, 268, '2203750850001C/19', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 269, '2203751000001A/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 189, '0403300450001/19', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 189, '0403300450002/19', 3, -7, 'ajuste por recuento de stock', 1),
(current_date, 190, '04033055001/17', 3, 6, 'ajuste por recuento de stock', 1),
(current_date, 176, 'C05033025004/21', 3, 1, 'ajuste por recuento de stock', 1),
(current_date, 177, 'C05033035001/21', 3, 1, 'ajuste por recuento de stock', 1),
(current_date, 178, '0503300450002/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 184, '0504500250003/20 - 0801800800003/20', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 185, '0504500350001/20', 3, -2, 'ajuste por recuento de stock', 1),
(current_date, 240, '4003302508002/18', 3, -1, 'ajuste por recuento de stock', 1),
(current_date, 241, '4003303508001/20', 3, 1, 'ajuste por recuento de stock', 1),
(current_date, 243, '4003302515002/18', 3, -9, 'ajuste por recuento de stock', 1),
(current_date, 244, '4003303515001/20', 3, 2, 'ajuste por recuento de stock', 1),
(current_date, 246, '4003302525001/19', 3, -2, 'ajuste por recuento de stock', 1),
(current_date, 247, '4003303525002/18', 3, 2, 'ajuste por recuento de stock', 1),
(current_date, 169, '020330020001/20', 3, -3, 'ajuste por recuento de stock', 1),
(current_date, 170, '0203300300002/20', 3, 12, 'ajuste por recuento de stock', 1),
(current_date, 227, '0203300600001/19', 3, 2, 'ajuste por recuento de stock', 1),
(current_date, 418, '0204500300001/21', 3, 2, 'ajuste por recuento de stock', 1),
(current_date, 174, '0204500350001/19', 3, -11, 'ajuste por recuento de stock', 1);


update lote set stock = 5 where zona_id = 3 and nro_lote = '1201202000001/20';
update lote set stock = 3 where zona_id = 3 and nro_lote = '1201201500001/18';
update lote set stock = 6 where zona_id = 3 and nro_lote = '4109300014001/20';
update lote set stock = 4 where zona_id = 3 and nro_lote = '1502340310002/19';
update lote set stock = 3 where zona_id = 3 and nro_lote = '5301300140001/20';
update lote set stock = 9 where zona_id = 3 and nro_lote = '5301100210001/20';
update lote set stock = 12 where zona_id = 3 and nro_lote = '5201300140001/20';
update lote set stock = 9 where zona_id = 3 and nro_lote = '5201100210001/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '1004500350001/18';
update lote set stock = 0 where zona_id = 3 and nro_lote = '3903750300003/19';
update lote set stock = 10 where zona_id = 3 and nro_lote = '4501500350003/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '0103500850002B/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '0103501000001C/19';
update lote set stock = 0 where zona_id = 3 and nro_lote = '2203501000002D/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '2203501150002D/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '2203501300002B/19';
update lote set stock = 0 where zona_id = 3 and nro_lote = '2203750850001C/19';
update lote set stock = 6 where zona_id = 3 and nro_lote = '2203751000001A/20';
update lote set stock = 12 where zona_id = 3 and nro_lote = '0403300450001/19';
update lote set stock = 0 where zona_id = 3 and nro_lote = '0403300450002/19';
update lote set stock = 7 where zona_id = 3 and nro_lote = '04033055001/17';
update lote set stock = 23 where zona_id = 3 and nro_lote = 'C05033025004/21';
update lote set stock = 5 where zona_id = 3 and nro_lote = 'C05033035001/21';
update lote set stock = 1 where zona_id = 3 and nro_lote = '0503300450002/20';
update lote set stock = 18 where zona_id = 3 and nro_lote = '0504500250003/20 - 0801800800003/20';
update lote set stock = 9 where zona_id = 3 and nro_lote = '0504500350001/20';
update lote set stock = 0 where zona_id = 3 and nro_lote = '4003302508002/18';
update lote set stock = 10 where zona_id = 3 and nro_lote = '4003303508001/20';
update lote set stock = 3 where zona_id = 3 and nro_lote = '4003302515002/18';
update lote set stock = 10 where zona_id = 3 and nro_lote = '4003303515001/20';
update lote set stock = 4 where zona_id = 3 and nro_lote = '4003302525001/19';
update lote set stock = 4 where zona_id = 3 and nro_lote = '4003303525002/18';
update lote set stock = 8 where zona_id = 3 and nro_lote = '020330020001/20';
update lote set stock = 16 where zona_id = 3 and nro_lote = '0203300300002/20';
update lote set stock = 5 where zona_id = 3 and nro_lote = '0203300600001/19';
update lote set stock = 8 where zona_id = 3 and nro_lote = '0204500300001/21';
update lote set stock = 5 where zona_id = 3 and nro_lote = '0204500350001/19';

create table temp_cobros
select cliente_id, sum(monto) as monto from cobro where fecha >= '2021-07-01' group by cliente_id;

create table temp_cobrado
select 
  fecha, 
  cliente_id
from resumen r
  join detalle_resumen dr on dr.resumen_id = r.id
  join cliente c on r.cliente_id = c.id
where c.zona_id = 3 and pagado = 0 and afip_estado = 1 and cliente_id in (select cliente_id from temp_cobros)
group by fecha, cliente_id;

update resumen set pagado = 1, fecha_pagado = (select max(fecha) from temp_cobros where temp_cobros.cliente_id = resumen.cliente_id) where afip_estado = 1 and pagado = 0 and cliente_id in (
  select cliente_id 
  from temp_cobrado 
  where (select sum(debe-haber) from cta_cte where cta_cte.cliente_id = temp_cobrado.cliente_id) <= 0.5
) or id in (8730, 8887, 8934);


delete from temp_cobrado;
insert into temp_cobrado
select 
  fecha, 
  cliente_id
from resumen r
  join detalle_resumen dr on dr.resumen_id = r.id
  join cliente c on r.cliente_id = c.id
where c.zona_id = 2 and pagado = 0 and afip_estado = 1 and cliente_id in (select cliente_id from temp_cobros)
group by fecha, cliente_id;

update resumen set pagado = 1, fecha_pagado = (select max(fecha) from temp_cobros where temp_cobros.cliente_id = resumen.cliente_id) where afip_estado = 1 and pagado = 0 and cliente_id in (
  select cliente_id 
  from temp_cobrado 
  where (select sum(debe-haber) from cta_cte where cta_cte.cliente_id = temp_cobrado.cliente_id) <= 0.5
) and id <> 8507;


drop table temp_cobros;
drop table temp_cobrado;

update resumen 
set fecha_pagado = (select min(fecha) from cobro where cobro.cliente_id = resumen.cliente_id and cobro.fecha >= resumen.fecha),
observacion = '-'
where zona_id = 2 and afip_estado = 1 and fecha < '2021-01-01' and fecha_pagado >= '2021-07-01';