<?php $moneda = $cta_cte->getMoneda()->getSimbolo(); ?>
<td class="sf_admin_text sf_admin_list_td_concepto">
  <?php echo get_partial('ctacte/concepto', array('type' => 'list', 'cta_cte' => $cta_cte)) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($cta_cte->getFecha()) ? implode('/', array_reverse(explode('-', $cta_cte->getFecha()))) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cliente">
  <?php echo $cta_cte->getCliente() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_debe <?php echo $estilo; ?>">
  <?php echo sprintf($moneda." %01.2f", $cta_cte->getDebe()) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_haber <?php echo $estilo; ?>">
  <?php echo sprintf($moneda." %01.2f", $cta_cte->getHaber()) ?>
</td>
<?php
$estilo = '';
if($saldo < 0) $estilo = 'moneda_negativo';
?>
<td class="sf_admin_text sf_admin_list_td_saldo <?php echo $estilo; ?>">
  <?php echo sprintf($moneda." %01.2f", $saldo) ?>
</td>
