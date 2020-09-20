<td class="sf_admin_text sf_admin_list_td_id">
  	<?php echo link_to($pedido->getId(), 'pedido_edit', $pedido) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  	<?php echo implode('/', array_reverse(explode('-', $pedido->getFecha()))) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha_venta">
	<?php echo implode('/', array_reverse(explode('-', $pedido->getFechaVenta()))) ?>
</td>
