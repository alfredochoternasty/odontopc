<html>
<head>
</head>
<body>
<h2>Listado de Ventas (solo totales)</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Bonificados</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->gettotal(); ?>
    <td><?php echo $fila->getGrupoNombre() ?></td>
    <td><?php echo $fila->getProductoNombre() ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo $fila->getBonificados() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>