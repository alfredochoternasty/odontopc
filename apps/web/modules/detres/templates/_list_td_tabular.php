<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $detalle_resumen->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $detalle_resumen->getNroLote() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo implode('/', array_reverse(explode('-', $detalle_resumen->getLote()->getFechaVto()))) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
  <?php echo $detalle_resumen->PrecioFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $detalle_resumen->getCantidad() ?>
</td>
<?php if($sf_user->hasGroup('Blanco')): ?>
<td class="sf_admin_text sf_admin_list_td_sub_total">
  <?php echo $detalle_resumen->SubTotalFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo $detalle_resumen->IvaFormato() ?>
</td>
<?php endif;?>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo $detalle_resumen->TotalFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_bonificados">
  <?php echo $detalle_resumen->getBonificados() ?>
</td>
