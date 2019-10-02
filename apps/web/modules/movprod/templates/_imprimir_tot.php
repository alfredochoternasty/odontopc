<html>
<head>
</head>
<body>
 <h2>Movimientos de Productos (solo totales) - <?php echo $listado[0]->getZona() ?></h2>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Bonificados</th>
    <th style="background: #CCC;">Devueltos</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->getTotal(); ?>
    <td><?php echo $fila->getGrupo() ?></td>
    <td><?php echo $fila->getNombre() ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo $fila->getBonificados() ?></td>
    <td><?php echo $fila->getCantDev() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>