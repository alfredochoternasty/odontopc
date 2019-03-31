<html>
<head>
</head>
<body>
<p>Productos Devueltos</p>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Comprobante</th>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Precio</th>
    <th style="background: #CCC;">Iva</th>
    <th style="background: #CCC;">Total</th>
  </tr>
  <?php 
  $total = 0;
  foreach($dev_productos as $dev):
  ?>
  <tr>
    <td><?php echo implode('/', array_reverse(explode('-', $dev->fecha))) ?></td>
    <td><?php echo $dev->getResumen() ?></td>
    <td><?php echo $dev->getCliente() ?></td>
    <td><?php echo utf8_decode($dev->getProducto()) ?></td>
    <td><?php echo $dev->getNroLote() ?></td>
    <td><?php echo $dev->getCantidad() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $dev->getCantidad()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $dev->getIva()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $dev->getTotal()) ?></td>
  </tr>
  <?php 
	$total += $dev->getTotal();
  endforeach;
  ?>
  <tr>
	<td colspan="7">&nbsp;</td>
    <td>Total: </td>
    <td><?php echo '$ '.sprintf("%01.2f", $total) ?></td>
  </tr>  
</table>
</body>
<html>