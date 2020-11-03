DELETE FROM sf_guard_user WHERE (id = '199');
DELETE FROM sf_guard_user WHERE (id = '237');
DELETE FROM sf_guard_user WHERE (id = '160');
DELETE FROM sf_guard_user WHERE (id = '193');
DELETE FROM sf_guard_user WHERE (id = '188');
DELETE FROM sf_guard_user WHERE (id = '216');
DELETE FROM sf_guard_user WHERE (id = '197');
DELETE FROM sf_guard_user WHERE (id = '205');
DELETE FROM sf_guard_user WHERE (id = '212');
DELETE FROM sf_guard_user WHERE (id = '150');
DELETE FROM sf_guard_user WHERE (id = '149');
DELETE FROM sf_guard_user WHERE (id = '280');
DELETE FROM sf_guard_user WHERE (id = '157');

update cliente set usuario_id = (select sf_guard_user.id from sf_guard_user where es_cliente = 1 and (username = dni or username = cuit))
where usuario_id is null and zona_id = 1 and activo = 1
and exists(select 1 from sf_guard_user where  es_cliente = 1 and (username = dni or username = cuit))

UPDATE cliente SET domicilio = 'Peĺlegrini 326 Gchu', telefono = '03446 437072', celular = '3446565626' WHERE (id = '371');
DELETE FROM cliente WHERE (id = '849');
UPDATE pedido SET cliente_id = '371' WHERE (id = '106');

UPDATE sf_guard_user SET is_active = '0' WHERE (id = '162');
UPDATE sf_guard_user SET is_active = '0' WHERE (id = '192');
