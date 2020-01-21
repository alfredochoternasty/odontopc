<?php use_helper('I18N', 'Date') ?>
<?php include_partial('inicio/assets') ?>

<div id="sf_admin_container">
	<?php include_partial('inicio/flashes') ?>
	<div id="sf_admin_content">
    <?php if(!$sf_user->hasPermission('traza')): ?>    
		<?php 
			$parametros = array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters);
			if (!empty($pager2)) $parametros['pager2'] = $pager2;
			include_partial('inicio/list', $parametros);
		?>
    <?php endif; ?>
	</div>
</div>
