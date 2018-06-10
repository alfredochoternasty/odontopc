<td class="sf_admin_text sf_admin_list_td_Tipo">
  <?php echo $cliente->getTipo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_apellido">
  <?php echo $cliente->getApellido() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nombre">
  <?php echo $cliente->getNombre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_moneda">
  <?php echo $cliente->getMoneda() ?>
</td>
<?php
$saldo = str_replace(',', '', $cliente->getSaldo());
$color = $saldo > 3000 ? " style='color:#f00'" : '';
?>
<td class="sf_admin_text sf_admin_list_td_saldo" <?php echo $color; ?> >
  <?php echo $cliente->getSimbolo() .' '. $cliente->getSaldo(); ?>
</td>
