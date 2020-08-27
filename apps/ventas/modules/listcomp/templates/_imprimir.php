<html>
<head>
</head>
<body>
<h2>Listado de Compras</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Numero</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Proveedor</th>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->gettotal(); ?>
    <td><?php echo $fila->getNumero() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getProvRazSoc() ?></td>
    <td><?php echo $fila->getGrupoNombre() ?></td>
    <td><?php echo $fila->getProductoNombre() ?></td>
    <td><?php echo $fila->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $fila->getPrecio()) ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getTotal()) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td">Total:</td>
    <td><?php echo sprintf("%01.2f", $suma_total) ?></td>
    <td>&nbsp;</td>
  </tr>  
</table>
</body>
<html>