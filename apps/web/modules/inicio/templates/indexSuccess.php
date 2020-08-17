<?php use_helper('I18N', 'Date') ?>
<?php include_partial('inicio/assets') ?>

<div id="sf_admin_container">
	<?php include_partial('inicio/flashes') ?>
    <?php if(!$sf_user->hasPermission('traza')): ?>    
		<?php 
			$parametros = array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters);
			if (!empty($pager2)) $parametros['pager2'] = $pager2;
			if (!empty($ventas)) $parametros['ventas'] = $ventas;
			if (!empty($clientes)) $parametros['clientes'] = $clientes;
			if (!empty($tipo_ventas)) $parametros['tipo_ventas'] = $tipo_ventas;
			$parametros['zona_id'] = $zona_id;
			include_partial('inicio/list', $parametros);
		?>
    <?php endif; ?>
</div>
