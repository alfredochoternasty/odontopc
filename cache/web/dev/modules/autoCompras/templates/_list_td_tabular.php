<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($compra2->getId(), 'compra2_edit', $compra2) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numero_compra">
  <?php echo $compra2->getNumeroCompra() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_proveedor_id">
  <?php echo $compra2->getProveedorId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($compra2->getFecha()) ? format_date($compra2->getFecha(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_producto_id">
  <?php echo $compra2->getProductoId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $compra2->getCantidad() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $compra2->getNroLote() ?>
</td>
