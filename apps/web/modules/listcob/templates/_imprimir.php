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
    <th style="background: #CCC;">Tipo</th>
    <th style="background: #CCC;">Tipo Cobro</th>
    <th style="background: #CCC;">Moneda</th>
    <th style="background: #CCC;">Cliente<br>Gen.Comis.</th>
    <th style="background: #CCC;">Monto</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->getMonto(); ?>
    <td><?php echo $fila->getId() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getTipoCliente() ?></td>
    <td><?php echo $fila->getMoneda() ?></td>
    <td><?php echo $fila->getTipoCobro() ?></td>
    <td><?php echo $fila->getCliGenComis()? "Si" : "No" ; ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getMonto()) ?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td">Total:</td>
    <td><?php echo '$ '.sprintf("%01.2f", $suma_total) ?></td>
  </tr>  
</table>
</body>
<html>