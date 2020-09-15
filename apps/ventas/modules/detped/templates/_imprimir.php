<html>
<head>
</head>
<body>
<h2>Pedido N&uacute;mero:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedidoId() ?></h2>
<p><b>Fecha:</b>&nbsp;&nbsp;<?php echo implode('/', array_reverse(explode('-', $detalles[0]->getPedido()->getFecha()))); ?></p>
<p><b>Obs:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedido()->getObservacion() ?></p>
<table width="100%" border="1" cellspacing="0" cellpadding="1">
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