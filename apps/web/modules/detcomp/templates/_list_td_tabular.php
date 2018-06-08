<td class="sf_admin_text sf_admin_list_td_Compra">
  <?php echo $detalle_compra->getCompra() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $detalle_compra->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $detalle_compra->getNroLote() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha_vto">
  <?php echo false !== strtotime($detalle_compra->getFechaVto()) ? format_date($detalle_compra->getFechaVto(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
  <?php echo $detalle_compra->PrecioFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $detalle_compra->getCantidad() ?>
</td>
<?php if($sf_user->hasGroup('Blanco')): ?>
<td class="sf_admin_text sf_admin_list_td_sub_total">
  <?php echo $detalle_compra->SubTotalFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_iva">
  <?php echo $detalle_compra->IvaFormato() ?>
</td>
<?php endif;?>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo $detalle_compra->TotalFormato() ?>
</td>
