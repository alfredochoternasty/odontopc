<?php include_partial('global/cabecera_impresion') ?>
<h2>Pedido</h2>
<p><b>N�mero:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedidoId() ?></p>
<p><b>Nombre y Apellido:</b>&nbsp;&nbsp;<?php echo $detalles[0]->getPedido()->getCliente() ?></p>
<p><b>Fecha:</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($detalles[0]->getPedido()->getFecha())) ?></p>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Precio Unitario</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Observacion</th>
    <th style="background: #CCC;">Asignacion Lote</th>
  </tr>
  <?php 
    $total = 0;
    foreach($detalles as $detalle):
  ?>
  <tr>
    <td><?php echo $detalle->getProducto() ?></td>
    <td><?php echo $detalle->getNroLote() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $detalle->PrecioFormato() ?></td>
    <td><?php echo $detalle->TotalFormato() ?></td>
    <td><?php echo $detalle->getObservacion() ?></td>
    <td><?php echo $detalle->getAsignacionLote() ?></td>
  </tr>
  <?php 
    $total += $detalle->getTotal();
    endforeach;
  ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td style="background: #CCC;">Total:&nbsp;</td>
    <td><?php echo sprintf($detalle->SimboloMoneda()." %01.2f", $total) ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?php include_partial('global/pie_impresion') ?>