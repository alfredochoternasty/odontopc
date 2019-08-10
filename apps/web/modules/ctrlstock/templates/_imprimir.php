<html>
<head>
</head>
<body>
<h2>Listado detallado para Control de Stock</h2>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Cant. Comprados</th>
    <th style="background: #CCC;">Cant. Vendidos</th>
    <th style="background: #CCC;">Stock</th>
  </tr>
  <?php 
	foreach($listado as $fila):
	?>
  <tr>
    <td><?php echo utf8_decode($fila->getProducto()->nombre) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
		<td style="text-align:center;"><?php echo $fila->getComprados() ?></td>
    <td style="text-align:center;"><?php echo (!empty($fila->vendidos))?$fila->getVendidos():'0'; ?></td>
    <td style="text-align:center;"><?php echo $fila->stock_guardado ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>