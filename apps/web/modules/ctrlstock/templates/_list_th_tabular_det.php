<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_producto_nombre ui-state-default ui-th-column">
  <?php if ('producto_nombre' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=producto_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Producto nombre', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=producto_nombre&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Producto nombre', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_fecha_vta ui-state-default ui-th-column">
  <?php if ('fecha_vta' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=fecha_vta&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Fecha Venta', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=fecha_vta&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Fecha Venta', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">
  <?php if ('nro_lote' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=nro_lote&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Lote', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=nro_lote&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Lote', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad_vendida ui-state-default ui-th-column">
  <?php if ('cantidad_vendida' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_vendida&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Cant. Vendidos', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_vendida&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Cant. Vendidos', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad_bonificados ui-state-default ui-th-column">
  <?php if ('cantidad_bonificados' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_bonificados&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Bonificados', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_bonificados&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Bonificados', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad_total ui-state-default ui-th-column">
  <?php if ('cantidad_total' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_total&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Total', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=cantidad_total&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Total', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_stock_actual ui-state-default ui-th-column">
  <?php if ('stock_actual' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=stock_actual&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Stock actual', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=stock_actual&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Stock actual', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_stock_actual ui-state-default ui-th-column">
  <?php if ('stock_sin_lote' == $sort[0]): ?>
    <a href="<?php echo url_for('@control_stock?sort=stock_sin_lote&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Stock s/lote', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@control_stock?sort=stock_sin_lote&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Stock s/lote', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>