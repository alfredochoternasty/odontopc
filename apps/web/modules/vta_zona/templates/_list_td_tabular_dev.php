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
  <?php echo $devuelto->precio; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad">
  <?php echo $devuelto->cantidad ?>
</td>
<td class="sf_admin_text sf_admin_list_td_neto">
</td>
<td class="sf_admin_text sf_admin_list_td_iva">
  <?php echo $devuelto->iva ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
  <?php echo $devuelto->total ?>
</td>
