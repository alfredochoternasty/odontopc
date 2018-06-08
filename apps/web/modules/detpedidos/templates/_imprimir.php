<html>
<head>
</head>
<body>
<h2>Pedido</h2>
<p><b>Número:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedidoId() ?></p>
<p><b>Nombre y Apellido:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedido()->getCliente() ?></p>
<p><b>Fecha:</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($detalles[0]->getPedido()->getFecha())) ?></p>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Precio Unitario</th>
    <th style="background: #CCC;">Total</th>
  </tr>
  <?php 
    $total = 0;
    foreach($detalles as $detalle):
  ?>
  <tr>
    <td><?php echo $detalle->getProducto() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $detalle->PrecioFormato() ?></td>
    <td><?php echo $detalle->TotalFormato() ?></td>
  </tr>
  <?php 
    $total += $detalle->getTotal();
    endforeach;
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="background: #CCC;">Total:&nbsp;</td>
    <td><?php echo sprintf($detalle->SimboloMoneda()." %01.2f", $total) ?></td>
  </tr>
</table>
</body>
<html>