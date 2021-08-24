<?php include_partial('global/cabecera_impresion') ?>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr><th colspan="6" style="background:#CCC;font-size:2em;">Deposito Producto de Distribución</th></tr>
  <tr>
    <th rowspan="2" style="background:#CCC;font-size:1.5em;">N° de Lote</th>
    <th colspan="3" style="background:#CCC;font-size:1.5em;" align="center">N° de Existencia por sector</th>
    <th colspan="2" align="center">Coincide con el registro de ingreso/egreso<br>(Marcar con una cruz según corresponda)</th>
  </tr>
  <tr>
    <td align="center" style="background:#CCC;font-size:1.3em;">Disponibles para comercialización</td>
    <td align="center" style="background:#CCC;font-size:1.3em;">No Conformes</td>
    <td align="center" style="background:#CCC;font-size:1.3em;">Devoluciones</td>
    <td align="center" style="background:#CCC;font-size:1.3em;">Si</td>
    <td align="center" style="background:#CCC;font-size:1.3em;">No</td>
  </tr>
  <?php 
	foreach($listado as $fila):
	?>
  <tr>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo utf8_decode($fila->getProducto()->nombre) ?></td>
		<td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">x</td>
    <td style="text-align:center;">&nbsp;</td>
  </tr>
  <?php endforeach;?>
</table>
<?php include_partial('global/pie_impresion') ?>