<html>
<head>
</head>
<body>
<h2>Listado de Compras</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Proveedor</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  
  <?php foreach($compras as $fila):?>
  <tr>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getProveedor() ?></td>
    <td><?php echo $fila->getProducto2() ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>