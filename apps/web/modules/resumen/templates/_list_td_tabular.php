<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($resumen->getId(), 'resumen_edit', $resumen) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($resumen->getFecha()) ? format_date($resumen->getFecha(), "dd/MM/yyyy") : '&nbsp;' ?>
</td>
<?php if($sf_user->hasGroup('Blanco')): ?>
<td class="sf_admin_text sf_admin_list_td_nro_factura">
  <?php echo $resumen->getNroFactura() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_factura">
  <?php echo $resumen->getTipoFactura() ?>
</td>
<?php endif;?>
<td class="sf_admin_text sf_admin_list_td_Cliente">
  <?php echo $resumen->getCliente() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo get_partial('resumen/total', array('type' => 'list', 'resumen' => $resumen)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Pedido">
  <?php echo $resumen->getPedido() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_observacion">
  <?php echo $resumen->getSfGuardUser() ?>
</td>
