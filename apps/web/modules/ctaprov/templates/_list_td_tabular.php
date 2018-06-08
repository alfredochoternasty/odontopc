<td class="sf_admin_text sf_admin_list_td_concepto">
  <?php echo get_partial('ctaprov/concepto', array('type' => 'list', 'cta_cte' => $cta_cte)) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_fecha">
  <?php echo false !== strtotime($cta_cte->getFecha()) ? format_date($cta_cte->getFecha(), "dd/MM/yyyy") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cliente">
  <?php echo $cta_cte->getProveedor() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_debe">
  <?php echo $cta_cte->getCuenta() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_debe">
  <?php echo $cta_cte->getDebe() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_haber">
  <?php echo $cta_cte->getHaber() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_saldo">
  <?php echo get_partial('ctaprov/saldo', array('type' => 'list', 'cta_cte' => $cta_cte, 'hasFilters' => $hasFilters)) ?>
</td>
