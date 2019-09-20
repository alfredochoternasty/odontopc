<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_producto ui-state-default ui-th-column">
  <?php echo __('Producto', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">
  <?php if ('nro_lote' == $sort[0]): ?>
    <a href="<?php echo url_for('@detalle_resumen?sort=nro_lote&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Nro lote', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@detalle_resumen?sort=nro_lote&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Nro lote', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">
  <?php if ('fecha_vto' == $sort[0]): ?>
    <a href="<?php echo url_for('@detalle_resumen?sort=fecha_vto&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Fec. Vto.', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@detalle_resumen?sort=nro_lote&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Fec. Vto.', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad ui-state-default ui-th-column">
	<?php if ('cantidad' == $sort[0]): ?>
		<a href="<?php echo url_for('@detalle_resumen?sort=cantidad&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
			<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
			<?php echo __('Cantidad', array(), 'messages') ?>
		</a>
	<?php else: ?>
		<a href="<?php echo url_for('@detalle_resumen?sort=cantidad&sort_type=asc') ?>">
			<span class="ui-icon ui-icon-triangle-2-n-s"></span>
			<?php echo __('Cantidad', array(), 'messages') ?>
		</a>
	<?php endif; ?>
</th>
<?php end_slot(); ?>

<?php if($res_tipo_factura == 4): ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad ui-state-default ui-th-column">
			<?php echo 'Cantidad Vendida'; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad ui-state-default ui-th-column">
			<?php echo 'Stock Remito'; ?>
</th>
<?php end_slot(); ?>
<?php endif; ?>

<?php if($res_tipo_factura != 4): ?>
	<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_precio ui-state-default ui-th-column">
		<?php if ('precio' == $sort[0]): ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=precio&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Precio Unitario', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=precio&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Precio Unitario', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_descuento ui-state-default ui-th-column">
		<?php if ('descuento' == $sort[0]): ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=descuento&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Descuento', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=descuento&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Descuento', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php if($sf_user->hasGroup('Blanco')): ?>
	<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_sub_total ui-state-default ui-th-column">
		<?php if ('sub_total' == $sort[0]): ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=sub_total&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Sub total', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=sub_total&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Sub total', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_iva ui-state-default ui-th-column">
		<?php if ('iva' == $sort[0]): ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=iva&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Monto IVA', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=iva&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Monto IVA', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php endif; ?>
	<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_total ui-state-default ui-th-column">
		<?php if ('total' == $sort[0]): ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=total&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Total', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@detalle_resumen?sort=total&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Total', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
<?php endif; ?>
<?php include_slot('sf_admin.current_header') ;  slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_descuento ui-state-default ui-th-column">
      <?php echo __('Observaciones', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>