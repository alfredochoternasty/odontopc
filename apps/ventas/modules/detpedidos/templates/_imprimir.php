<?php include_partial('global/cabecera_impresion') ?>
<h2>Pedido</h2>
<b>Nro : </b><?php echo $detalles[0]->getPedidoId() ?><br>
<b>Cliente : </b><?php echo $detalles[0]->getPedido()->getCliente() ?><br>
<b>Fecha : </b><?php echo date("d/m/Y", strtotime($detalles[0]->getPedido()->getFecha())) ?><br>
<b>Entrega en : </b><?php echo $detalles[0]->getPedido()->direccion_entrega ?><br>
<br>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <?php if ($lotes): ?>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Asignacion Lote</th>
    <?php endif; ?>
  </tr>
  <?php foreach($detalles as $detalle): ?>
  <tr>
    <td><?php echo $detalle->getProducto() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <?php if ($lotes): ?>
    <td><?php echo $detalle->getNroLote() ?></td>
    <td><?php echo $detalle->getAsignacionLote() ?></td>
    <?php endif; ?>
  </tr>
  <?php endforeach; ?>
</table>
<?php include_partial('global/pie_impresion') ?>