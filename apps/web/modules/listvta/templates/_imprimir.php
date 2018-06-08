<html>
<head>
</head>
<body>
<h2>Listado de Ventas</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Venta</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio</th>
    <th style="background: #CCC;">Cant.</th>
    <th style="background: #CCC;">Bonif.</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Vto. Lote</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->gettotal(); ?>
    <td><?php echo $fila->getResId() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getClienteApellido() . ' ' . $fila->getClienteNombre() ?></td>
    <td><?php echo $fila->getGrupoNombre() ?></td>
    <td><?php echo $fila->getProductoNombre() ?></td>
    <td><?php echo $fila->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $fila->getPrecio()) ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo $fila->getBonificados() ?></td>
    <td><?php echo $fila->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $fila->getTotal()) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
    <td><?php echo $fila->getFechaVto() ?></td>
  </tr>
  <?php endforeach;?> 
</table>
</body>
<html>