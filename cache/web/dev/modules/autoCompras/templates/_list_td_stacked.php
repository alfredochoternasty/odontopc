<td colspan="7">
  <?php echo __('%%id%% - %%numero_compra%% - %%proveedor_id%% - %%fecha%% - %%producto_id%% - %%cantidad%% - %%nro_lote%%', array('%%id%%' => link_to($compra2->getId(), 'compra2_edit', $compra2), '%%numero_compra%%' => $compra2->getNumeroCompra(), '%%proveedor_id%%' => $compra2->getProveedorId(), '%%fecha%%' => false !== strtotime($compra2->getFecha()) ? format_date($compra2->getFecha(), "f") : '&nbsp;', '%%producto_id%%' => $compra2->getProductoId(), '%%cantidad%%' => $compra2->getCantidad(), '%%nro_lote%%' => $compra2->getNroLote()), 'messages') ?>
</td>
