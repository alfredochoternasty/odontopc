<div style="position:relative" class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<?php
	$base_url = $sf_user->getVarConfig('base_url');
	if (!$sf_user->getGuardUser()->es_cliente) {
		$usuario = $sf_user->getGuardUser()->getId();
		$uz = Doctrine_Core::getTable('UsuarioZona')->findByUsuario($usuario);
		if ($uz[0]->zona_id > 1) {
			echo '<div style="width:100%;margin-top:10%;text-align:center;"><img src="'.$base_url.'/web/images/home.png"></div>';
		} else {
			// if ($sf_user->hasCredential('Stock Minimo'))
				include_partial('stock_minimo', array('pager' => $pager));
			
			$modulo_pedidos = $sf_user->getVarConfig('modulo_pedidos');
			if (!empty($pager2) && $modulo_pedidos == 'S' && $sf_user->hasCredential('Pedidos Nuevos')) 
				include_partial('ped_pend', array('pager2' => $pager2));
			
			include_partial('ventas', array('ventas' => $ventas, 'zona_id' => $zona_id));
			include_partial('clientes', array('clientes' => $clientes));
			include_partial('tipo_ventas', array('tipo_ventas' => $tipo_ventas));
		}
	} else {
		echo '<div style="width:100%;margin-top:10%;text-align:center;"><img src="'.$base_url.'/web/images/home.png"></div>';
	}
?>
</div>