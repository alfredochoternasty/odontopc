<html>
<head>
</head>
<body>
<h2>Listado detallado para Control de Stock</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Fecha Venta</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Cant. Vendidos</th>
    <th style="background: #CCC;">Cant. Bonificados</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Stock Actual</th>
    <th style="background: #CCC;">Stock s/Lote</th>
  </tr>
  <?php foreach($listado as $fila):?>
  <tr>
    <td><?php echo $fila->getProductoNombre() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFechaVta()))) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo $fila->getCantidadVendida() ?></td>
    <td><?php echo $fila->getCantidadBonificados() ?></td>
    <td><?php echo $fila->getCantidadTotal() ?></td>
    <td><?php echo $fila->getStockActual() ?></td>
    <td><?php echo $fila->getStockSinLote() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>