<html>
<head>
</head>
<body>
<h2>Traza de Productos</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cant. Vendida</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Fecha de Venta</th>
    <th style="background: #CCC;">Cliente</th>
  </tr>
  <?php 
    foreach($traza as $prod):?>
  <tr>
    <td><?php echo utf8_decode($prod->getProducto2()) ?></td>
    <td><?php echo $prod->getCantVendida() ?></td>
    <td><?php echo $prod->getNroLote() ?></td>
    <td><?php echo date("d/m/Y", strtotime($prod->getFechaVenta()))?></td>
    <td><?php echo $prod->getCliente() ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<p>&nbsp;</p>
<p style="text-align: right; width: 100%; "><b>Fecha de Impresi&oacute;n:</b>&nbsp;&nbsp;<?php echo date("d/m/Y") ?></p>
</body>
<html>
