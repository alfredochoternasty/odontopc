<td colspan="5">
  <?php echo __('%%Producto2%% - %%cant_vendida%% - %%nro_lote%% - %%fecha_venta%% - %%Cliente%%', array('%%Producto2%%' => $traza2->getProducto2(), '%%cant_vendida%%' => $traza2->getCantVendida(), '%%nro_lote%%' => $traza2->getNroLote(), '%%fecha_venta%%' => false !== strtotime($traza2->getFechaVenta()) ? format_date($traza2->getFechaVenta(), "dd/MM/yyyy") : '&nbsp;', '%%Cliente%%' => $traza2->getCliente()), 'messages') ?>
</td>
