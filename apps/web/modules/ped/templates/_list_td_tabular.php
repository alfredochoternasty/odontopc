<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($pedido->getId(), 'pedido_edit', $pedido) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($pedido->getFecha()) ? format_date($pedido->getFecha(), "dd/MM/yyyy") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha_venta">
  <?php echo false !== strtotime($pedido->getFechaVenta()) ? format_date($pedido->getFechaVenta(), "dd/MM/yyyy") : '&nbsp;' ?>
</td>
