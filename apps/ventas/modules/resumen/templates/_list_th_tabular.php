<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_Zona ui-state-default ui-th-column">
  <?php echo __('Zona', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_factura ui-state-default ui-th-column">
  <?php echo __('Factura', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">
  <?php if ('fecha' == $sort[0]): ?>

    <a href="<?php echo url_for('@resumen?sort=fecha&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Fecha', array(), 'messages') ?>
    </a>

  <?php else: ?>

    <a href="<?php echo url_for('@resumen?sort=fecha&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Fecha', array(), 'messages') ?>
    </a>

  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_total ui-state-default ui-th-column">
  <?php echo __('Total', array(), 'messages') ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_Cliente ui-state-default ui-th-column">
  <?php echo __('Cliente', array(), 'messages') ?>
</th>
<?php end_slot(); ?>

<?php
	$modulo_factura = $sf_user->getVarConfig('modulo_factura');
	if ($modulo_factura == 'S') {
?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_afip_estado ui-state-default ui-th-column">
  <?php if ('afip_estado' == $sort[0]): ?>
    <a href="<?php echo url_for('@resumen?sort=afip_estado&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('AFIP', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@resumen?sort=afip_estado&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('AFIP', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php } ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_obs ui-state-default ui-th-column">
  <?php echo __('Obs', array(), 'messages') ?>
</th>
<?php end_slot(); ?>

<?php if ($sf_user->getGuardUser()->getZonaId() > 1): ?>
  <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
  <th class="sf_admin_text sf_admin_list_th_obs ui-state-default ui-th-column">
    <?php echo __('Pagado', array(), 'messages') ?>
  </th>
  <?php end_slot(); ?>
<?php endif; ?>

<?php include_slot('sf_admin.current_header') ?>