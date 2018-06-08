<html>
<head>
</head>
<body>
<h2>Presupuesto</h2>
<p><b>Descripcion:</b>&nbsp;&nbsp;<?php echo $presupuesto->getDescripcion() ?></p>
<p><b>Fecha:</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($presupuesto->getFecha())) ?></p>
<?php $moneda = $presupuesto->getLista()->getMoneda()->getSimbolo(); ?>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Precio Unitario</th>
    <th style="background: #CCC;">Total</th>
  </tr>
  <?php 
  $total = 0;
  foreach($presupuesto->getDetallePresupuesto() as $detalle):
  ?>
  <tr>
    <td><?php echo $detalle->getProducto() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $moneda.' '.sprintf("%01.2f", $detalle->getPrecio()) ?></td>
    <td><?php echo $moneda.' '.sprintf("%01.2f", $detalle->getTotal()) ?></td>
  </tr>
  <?php 
	$total += $detalle->getTotal();
  endforeach;
  ?>
  <tr>
	<td colspan="2">&nbsp;</td>
    <td>Total: </td>
    <td><?php echo $moneda.' '.sprintf("%01.2f", $total) ?></td>
  </tr>  
</table>
</body>
<html>