<html>
<head>
</head>
<body>
<p><b>Cuit:</b>&nbsp;&nbsp;<?php echo $cta_cte[0]->getProveedor()->getCuit() ?></p>
<p><b>Razon Social:</b>&nbsp;&nbsp;<?php echo $cta_cte[0]->getProveedor() ?></p>
<p><b>Domicilio:</b>&nbsp;&nbsp;<?php echo $cta_cte[0]->getProveedor()->getDomicilio() ?> - <?php echo $cta_cte[0]->getProveedor()->getLocalidad() ?></p>
<p><b>Tel&eacute;fono:</b>&nbsp;&nbsp;<?php echo $cta_cte[0]->getProveedor()->getTelefono() ?></p>
<p><b>Email:</b>&nbsp;&nbsp;<?php echo $cta_cte[0]->getProveedor()->getEmail() ?></p>
<p>&nbsp;</p>
<h2>Cuenta Corriente de la cuenta <?php echo $cta_cte[0]->getCuenta() ?></h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
  <tr>
    <th style="background: #CCC;">Concepto</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Debe</th>
    <th style="background: #CCC;">Haber</th>
    <th style="background: #CCC;">Saldo</th>
  </tr>
  <?php 
    $saldo = 0;
    $fi = implode("/", array_reverse(explode("-", $cta_cte[0]->getFecha()))); 
    foreach($cta_cte as $ctacte):?>
  <tr>
    <?php $saldo += $ctacte->getDebe() - $ctacte->getHaber(); ?>
    <td><?php echo $ctacte->getConcepto() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $ctacte->getFecha()))) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $ctacte->getDebe()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $ctacte->getHaber()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $saldo) ?></td>
  </tr>
  <?php
      $ff = implode("/", array_reverse(explode("-", $ctacte->getFecha()))); 
    endforeach;
  ?>
  <tr>
    <td style="text-align: right;" colspan="4"><?php echo 'Saldo desde el '.$fi.' al '.$ff ?></td>
    <td><?php echo '$'.sprintf("%01.2f", $saldo) ?></td>
  </tr>
  <tr>
    <td style="text-align: right;" colspan="4"><?php echo 'Saldo total' ?></td>
    <td><?php echo '$'.sprintf("%01.2f", $cta_cte[0]->getProveedor()->getSaldoCtaCte($cta_cte[0]->getCuenta()->getId())) ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p style="text-align: right; width: 100%; "><b>Fecha de Impresi&oacute;n:</b>&nbsp;&nbsp;<?php echo date("d/m/Y") ?></p>
</body>
<html>
