<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $detalle_pedido->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $detalle_pedido->getNroLote() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
  <?php echo $detalle_pedido->PrecioFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $detalle_pedido->getCantidad() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo $detalle_pedido->TotalFormato() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_observacion">
  <?php echo $detalle_pedido->getObservacion() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_asignacion_lote">
  <?php echo $detalle_pedido->getAsignacionLote() ?>
</td>

