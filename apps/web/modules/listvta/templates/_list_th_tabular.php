<?php 
$ver_solo_totales = $sf_user->getAttribute('totales', true);
if (!$ver_solo_totales) {
	slot('sf_admin.current_header');
	?>
	<th class="sf_admin_foreignkey sf_admin_list_th_resumen_id ui-state-default ui-th-column">
		<?php if ('resumen_id' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=resumen_id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Venta', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=resumen_id&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Venta', array(), 'messages') ?>
			</a>

		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">
		<?php if ('fecha' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=fecha&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Fecha', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=fecha&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Fecha', array(), 'messages') ?>
			</a>

		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_Moneda ui-state-default ui-th-column">
		<?php echo __('Moneda', array(), 'messages') ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_cliente_apellido ui-state-default ui-th-column">
		<?php if ('cliente_apellido' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=cliente_apellido&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Apellido', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=cliente_apellido&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Apellido', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_cliente_nombre ui-state-default ui-th-column">
		<?php if ('cliente_nombre' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=cliente_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Nombre', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=cliente_nombre&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Nombre', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_tipo_cliente_nombre ui-state-default ui-th-column">
		<?php if ('tipo_cliente_nombre' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=tipo_cliente_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Tipo', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=tipo_cliente_nombre&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Tipo', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); 
}?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_grupo_nombre ui-state-default ui-th-column">
  <?php if ('grupo_nombre' == $sort[0]): ?>
    <a href="<?php echo url_for('@listado_ventas?sort=grupo_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Grupo', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@listado_ventas?sort=grupo_nombre&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Grupo', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_producto_nombre ui-state-default ui-th-column">
  <?php if ('producto_nombre' == $sort[0]): ?>
    <a href="<?php echo url_for('@listado_ventas?sort=producto_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Producto', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@listado_ventas?sort=producto_nombre&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Producto', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php if(!$ver_solo_totales){ ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_precio ui-state-default ui-th-column">
		<?php if ('precio' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=precio&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Precio', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=precio&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Precio', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); 
} ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_cantidad ui-state-default ui-th-column">
  <?php if ('cantidad' == $sort[0]): ?>
    <a href="<?php echo url_for('@listado_ventas?sort=cantidad&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Cantidad', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@listado_ventas?sort=cantidad&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Cantidad', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_bonificados ui-state-default ui-th-column">
  <?php if ('bonificados' == $sort[0]): ?>
    <a href="<?php echo url_for('@listado_ventas?sort=bonificados&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Bonificados.', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@listado_ventas?sort=bonificados&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Bonificados.', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_total ui-state-default ui-th-column">
  <?php if ('total' == $sort[0]): ?>
    <a href="<?php echo url_for('@listado_ventas?sort=total&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Total', array(), 'messages') ?>
    </a>
  <?php else: ?>
    <a href="<?php echo url_for('@listado_ventas?sort=total&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Total', array(), 'messages') ?>
    </a>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php if(!$ver_solo_totales){ ?>
	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">
		<?php if ('nro_lote' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=nro_lote&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Lote', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=nro_lote&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Lote', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot(); ?>

	<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	<th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">
		<?php if ('fecha_vto' == $sort[0]): ?>
			<a href="<?php echo url_for('@listado_ventas?sort=fecha_vto&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
				<span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
				<?php echo __('Fecha Vto.', array(), 'messages') ?>
			</a>
		<?php else: ?>
			<a href="<?php echo url_for('@listado_ventas?sort=fecha_vto&sort_type=asc') ?>">
				<span class="ui-icon ui-icon-triangle-2-n-s"></span>
				<?php echo __('Fecha Vto.', array(), 'messages') ?>
			</a>
		<?php endif; ?>
	</th>
	<?php end_slot();
} 
?>