<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($devuelto->getFecha()) ? implode('/', array_reverse(explode('-', $devuelto->getFecha()))) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Resumen">
  <?php echo $devuelto ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Zona">
  <?php echo $devuelto->getZona() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Cliente">
  <?php echo $devuelto->getCliente() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $devuelto->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
<?php echo '$ '.number_format($devuelto->precio, 2, ',', '.'); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $devuelto->cantidad ?>
</td>
<td class="sf_admin_text sf_admin_list_td_neto">
  <?php echo '$ '.number_format($devuelto->getSubTotal(), 2, ',', '.'); ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_pagado">
  <?php echo get_partial('vta_zona/list_field_boolean', array('value' => !empty($devuelto->getPagoComisionId()))) ?>
</td>
<td class="sf_admin_text">
  <?php echo $devuelto->getPorcentajeComision().'%'; ?>
</td>
<td class="sf_admin_text">
  <?php echo '$ '.number_format($devuelto->getComision(), 2, ',', '.'); ?>
</td>