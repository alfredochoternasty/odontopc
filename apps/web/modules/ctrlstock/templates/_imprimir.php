<html>
<head>
</head>
<body>
<h2>Listado detallado para Control de Stock</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Cant. Comprados</th>
    <th style="background: #CCC;">Cant. Vendidos</th>
    <th style="background: #CCC;">Stock</th>
  </tr>
  <?php foreach($listado as $fila):?>
  <tr>
    <td><?php echo $fila->getProducto() ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo $fila->getCantVendida() ?></td>
    <td><?php echo $fila->getCantComprada() ?></td>
    <td><?php echo $fila->getStock() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>