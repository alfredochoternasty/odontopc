<?php include_partial('global/cabecera_impresion') ?>
<table border="1" cellspacing="0" cellpadding="1" width="100%" style="font-size:1.5em">
  <tr><th colspan="5" style="background:#CCC;font-size:1.5em;">R-2.03-02 Control de Inventario</th></tr>
  <tr>
    <td colspan="3" align="center">Ref.: PO-2.03</td>
    <td colspan="2" align="center">Rev.: 04</td>
  </tr>
  <tr><td colspan="5">&nbsp;</td></tr>
  <tr>
    <td colspan="2">&nbsp;&nbsp;Fecha: <?php echo date("d/m/Y") ?></td>
    <td colspan="3" align="center">N° 1</td>
  </tr>
  <tr>
    <th colspan="5" style="background: #CCC;">Depósito de producto terminado: Producto fabricado</th>
  </tr>
  <tr>
    <th style="background: #CCC;">N° de Lote</th>
    <th style="background: #CCC;">Liberados</th>
    <th style="background: #CCC;">No Conformes</th>
    <th style="background: #CCC;">Devoluciones</th>
    <th style="background: #CCC;">Observaciones</th>
  </tr>
  <?php 
	foreach($listado as $fila):
	?>
  <tr>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo utf8_decode($fila->getProducto()->nombre) ?></td>
		<td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
  </tr>
  <?php endforeach;?>
</table>
<?php include_partial('global/pie_impresion') ?>