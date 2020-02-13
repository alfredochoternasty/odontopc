<h1>Detalle pedidos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Pedido</th>
      <th>Producto</th>
      <th>Precio</th>
      <th>Cantidad</th>
      <th>Total</th>
      <th>Observacion</th>
      <th>Nro lote</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle_pedidos as $detalle_pedido): ?>
    <tr>
      <td><a href="<?php echo url_for('carrito/edit?id='.$detalle_pedido->getId()) ?>"><?php echo $detalle_pedido->getId() ?></a></td>
      <td><?php echo $detalle_pedido->getPedidoId() ?></td>
      <td><?php echo $detalle_pedido->getProductoId() ?></td>
      <td><?php echo $detalle_pedido->getPrecio() ?></td>
      <td><?php echo $detalle_pedido->getCantidad() ?></td>
      <td><?php echo $detalle_pedido->getTotal() ?></td>
      <td><?php echo $detalle_pedido->getObservacion() ?></td>
      <td><?php echo $detalle_pedido->getNroLote() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('carrito/new') ?>">New</a>
