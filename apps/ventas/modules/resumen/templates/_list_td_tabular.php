<td class="sf_admin_text sf_admin_list_td_Zona">
  <?php echo $resumen->getZona() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_factura">
  <?php echo get_partial('resumen/factura', array('type' => 'list', 'resumen' => $resumen)) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($resumen->getFecha()) ? implode('/', array_reverse(explode('-', $resumen->getFecha()))) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo get_partial('resumen/total', array('type' => 'list', 'resumen' => $resumen)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Cliente">
  <?php echo $resumen->getCliente() ?>
</td>
<?php
	$modulo_factura = $sf_user->getVarConfig('modulo_factura');
	if ($modulo_factura == 'S') {
?>
		<td class="sf_admin_text sf_admin_list_td_afip_estado">
			<?php echo get_partial('resumen/afip_estado', array('type' => 'list', 'resumen' => $resumen)) ?>
		</td>
<?php 
	} 
?>
<td class="sf_admin_text sf_admin_list_td_obs">
  <?php echo get_partial('resumen/obs', array('type' => 'list', 'resumen' => $resumen)) ?>
</td>
<?php if ($sf_user->getGuardUser()->getZonaId() > 1) { ?>
		<td class="sf_admin_text sf_admin_list_td_afip_estado">
			<?php echo get_partial('resumen/pagada', array('type' => 'list', 'resumen' => $resumen)) ?>
		</td>
<?php } ?>