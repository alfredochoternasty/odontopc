<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($ventas_zona->getFecha()) ? implode('/', array_reverse(explode('-', $ventas_zona->getFecha()))) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Resumen">
  <?php echo $ventas_zona->getResumen() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Zona">
  <?php echo $ventas_zona->getZona() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Cliente">
  <?php echo $ventas_zona->getCliente() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $ventas_zona->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
  <?php echo get_partial('vta_zona/precio', array('type' => 'list', 'ventas_zona' => $ventas_zona)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo get_partial('vta_zona/cantidad', array('type' => 'list', 'ventas_zona' => $ventas_zona)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_descuento">
  <?php echo get_partial('vta_zona/descuento', array('type' => 'list', 'ventas_zona' => $ventas_zona)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_neto">
  <?php echo get_partial('vta_zona/neto', array('type' => 'list', 'ventas_zona' => $ventas_zona)) ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_cobrado">
  <?php echo get_partial('vta_zona/list_field_boolean', array('value' => $ventas_zona->getCobrado())) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha_cobrado">
  <?php echo false !== strtotime($ventas_zona->getFechaCobrado()) ? implode('/', array_reverse(explode('-', $ventas_zona->getFechaCobrado()))) : '&nbsp;' ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_pagado">
  <?php echo get_partial('vta_zona/list_field_boolean', array('value' => $ventas_zona->getPagado())) ?>
</td>
<td class="sf_admin_text">
  <?php echo $ventas_zona->getPorcentajeComision().'%'; ?>
</td>
<td class="sf_admin_text">
  <?php echo '$ '.number_format($ventas_zona->getComision(), 2, ',', '.'); ?>
</td>