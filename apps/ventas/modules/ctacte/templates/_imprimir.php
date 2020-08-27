<?php include_partial('global/cabecera_impresion') ?>
<h2 id="titulo">Cuenta Corriente</h2>
<h3>Nombre y Apellido:&nbsp;&nbsp;<?php echo $cta_cte[0]->getCliente().' ('.$cta_cte[0]->getCliente()->getDni().')' ?></h3>
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
    $saldo_anterior = $cta_cte[0]->getCliente()->getSaldoCtaCte($cta_cte[0]->getMonedaId(), $cta_cte[0]->getFecha());
    $saldo += $saldo_anterior;
  ?>
  <tr>
    <td style="text-align: right;" colspan="4"><?php echo 'Saldo al '.$fi ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $saldo_anterior) ?></td>
  </tr>
  <?php
    foreach($cta_cte as $ctacte):?>
  <tr>
    <?php $saldo += $ctacte->getDebe() - $ctacte->getHaber(); ?>
    <td><?php 
if ($ctacte->concepto == 'Venta') {
	echo Doctrine::getTable('Resumen')->find($ctacte->numero);
} elseif ($ctacte->concepto == 'Cobro') {
	echo "RECIBO DE COBRO 0005 - ".str_pad($ctacte->numero, 8, 0, STR_PAD_LEFT);
} elseif ($ctacte->concepto == 'Devolución') {
	$cobro = Doctrine::getTable('Cobro')->find($ctacte->numero);
	echo Doctrine::getTable('DevProducto')->find($cobro->devprod_id);
} else {
	echo $ctacte->concepto." - #".$ctacte->getNumero();
}		
		?></td>
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
    <td><?php echo '$'.sprintf("%01.2f", $cta_cte[0]->getCliente()->getSaldoCtaCte($cta_cte[0]->getMonedaId())) ?></td>
  </tr>
</table>
<?php include_partial('global/pie_impresion') ?>