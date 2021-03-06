<?php include_partial('global/cabecera_impresion') ?>
<h2>Listado para Control de Stock - <?php echo $listado[0]->getZona() ?></h2>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Comprados</th>
    <th style="background: #CCC;">Vendidos</th>
    <th style="background: #CCC;">Stock</th>
    <th style="background: #CCC;">Ult. Movimiento<br>(Vta/Dev)</th>
  </tr>
  <?php 
	foreach($listado as $fila):
	?>
  <tr>
    <td><?php echo utf8_decode($fila->getProducto()->nombre) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
		<td style="text-align:center;"><?php echo $fila->getComprados() ?></td>
    <td style="text-align:center;"><?php echo (!empty($fila->vendidos))?$fila->vendidos - $fila->cant_dev:'0'; ?></td>
    <td style="text-align:center;"><?php echo $fila->stock_guardado ?></td>
    <td style="text-align:center;"><?php echo implode('/', array_reverse(explode('-', $fila->ult_venta))) ?></td>
  </tr>
  <?php endforeach;?>
</table>
<?php include_partial('global/pie_impresion') ?>