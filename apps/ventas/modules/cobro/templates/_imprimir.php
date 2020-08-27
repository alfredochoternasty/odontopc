<html>
<head>
</head>
<body>
<h2>Listado de Cobros Realizados</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Monto</th>
    <th style="background: #CCC;">Tipo</th>
    <th style="background: #CCC;">Banco</th>
    <th style="background: #CCC;">Número</th>
    <th style="background: #CCC;">Observacion</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):?>
  <tr>
    <?php $suma_total += $fila->getMonto(); ?>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $fila->getMonto()) ?></td>
    <td><?php echo $fila->getTipo() ?></td>
    <td><?php echo $fila->getBanco() ?></td>
    <td><?php echo $fila->getNumero() ?></td>
    <td><?php echo $fila->getObservacion() ?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td>
    <td>Total:</td>
    <td><?php echo '$ '.sprintf("%01.2f", $suma_total) ?></td>
    <td colspan="4">&nbsp;</td>
  </tr>  
</table>
</body>
<html>