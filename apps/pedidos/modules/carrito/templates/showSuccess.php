<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $detalle_pedido->getId() ?></td>
    </tr>
    <tr>
      <th>Pedido:</th>
      <td><?php echo $detalle_pedido->getPedidoId() ?></td>
    </tr>
    <tr>
      <th>Producto:</th>
      <td><?php echo $detalle_pedido->getProductoId() ?></td>
    </tr>
    <tr>
      <th>Precio:</th>
      <td><?php echo $detalle_pedido->getPrecio() ?></td>
    </tr>
    <tr>
      <th>Cantidad:</th>
      <td><?php echo $detalle_pedido->getCantidad() ?></td>
    </tr>
    <tr>
      <th>Total:</th>
      <td><?php echo $detalle_pedido->getTotal() ?></td>
    </tr>
    <tr>
      <th>Observacion:</th>
      <td><?php echo $detalle_pedido->getObservacion() ?></td>
    </tr>
    <tr>
      <th>Nro lote:</th>
      <td><?php echo $detalle_pedido->getNroLote() ?></td>
    </tr>
    <tr>
      <th>Asignacion lote:</th>
      <td><?php echo $detalle_pedido->getAsignacionLote() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('carrito/edit?id='.$detalle_pedido->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('carrito/index') ?>">List</a>
