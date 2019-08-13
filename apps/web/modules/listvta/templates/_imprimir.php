<html>
<head>
</head>
<body>
<h2>Listado de Ventas - <?php echo $listado[0]->getZona() ?></h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Venta</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio</th>
    <th style="background: #CCC;">Cant.</th>
    <th style="background: #CCC;">neto</th>
    <th style="background: #CCC;">iva</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Devueltos</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->getTotal(); ?>
    <td><?php echo $fila->getResumen() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getPrecio()) ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getSubTotal()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getIva()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getTotal()) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo $fila->getCantDev() ?></td>
  </tr>
  <?php endforeach;?> 
</table>
</body>
<html>