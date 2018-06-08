<td class="sf_admin_text sf_admin_list_td_c_fiscal">
  <?php echo get_partial('cli/c_fiscal', array('type' => 'list', 'cliente' => $cliente)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_apellido">
  <?php echo $cliente->getApellido() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nombre">
  <?php echo $cliente->getNombre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_direccion">
  <?php echo get_partial('cli/direccion', array('type' => 'list', 'cliente' => $cliente)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_telefonos">
  <?php echo get_partial('cli/telefonos', array('type' => 'list', 'cliente' => $cliente)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $cliente->getEmail() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_activo">
  <?php echo get_partial('cli/list_field_boolean', array('value' => $cliente->getActivo())) ?>
</td>
