<?php
/*
$conn = mysql_connect('localhost', 'traza', 'jgE3d7_9');
mysql_select_db('ventas', $conn);
*/

$obj = $_POST['content'];
file_put_contents('log_cliente.txt', print_r($obj))
echo true;
/*

$sql =  'select producto_id, nro_lote, nro_factura, fecha, cliente_id, cantidad from detalle_resumen dr join resumen r on dr.resumen_id = r.id ';
$sql .=  'where producto_id in (select id from producto2) and nro_lote not like \'i0%\' and exportado = 0';
$rs = mysql_query($sql);
while($row = mysql_fetch_row($rs)){
  echo ' insert into traza2(producto_id, nro_lote, nro_venta, fecha_venta, cliente_id, cant_vendida) values(\''.implode('\', \'', $row).'\');';
}
$sql =  'update detalle_resumen set exportado = 1 where producto_id in (select id from producto2) and exportado = 0';
$rs = mysql_query($sql);

$sql = 'select c.numero, c.proveedor_id, c.fecha, dc.producto_id, dc.cantidad, dc.nro_lote ';
$sql .= 'from detalle_compra dc join compra c on dc.compra_id = c.id ';
$sql .= 'where dc.producto_id in (select id from producto2) and exportado = 0 and nro_lote not like \'i0%\'';
$rs = mysql_query($sql);
while($row = mysql_fetch_row($rs)){
  echo ' insert into compra2(numero, proveedor_id, fecha, producto_id, cantidad, nro_lote) values(\''.implode('\', \'', $row).'\');';
}
$sql =  'update detalle_compra set exportado = 1 where producto_id in (select id from producto2) and exportado = 0';
$rs = mysql_query($sql);
*/

?>