<td class="sf_admin_text sf_admin_list_td_Producto2">
  <?php echo $traza2->getProducto2() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cant_vendida">
  <?php echo $traza2->getCantVendida() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $traza2->getNroLote() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha_venta">
  <?php echo false !== strtotime($traza2->getFechaVenta()) ? format_date($traza2->getFechaVenta(), "dd/MM/yyyy") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Cliente">
  <?php echo $traza2->getCliente() ?>
</td>
