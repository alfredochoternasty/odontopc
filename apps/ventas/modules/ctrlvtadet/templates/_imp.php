<html>
<head>
</head>
<body>
<h2>Listado de Ventas y Remitos</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Venta</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cant.</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  <?php foreach($listado_ventass as $fila):
    if ($fila->cantidad > 0) :
  ?>
  <tr>
    <td><?php echo $fila->getResumen() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getNombre() ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
  </tr>
  <?php endif; ?> 
  <?php endforeach; ?> 
</table>
</body>
<html>