<div style="position:relative" class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<?php
	if (!$sf_user->getGuardUser()->es_cliente) {
		$usuario = $sf_user->getGuardUser()->getId();
		$uz = Doctrine_Core::getTable('UsuarioZona')->findByUsuario($usuario);
		if ($uz[0]->zona_id > 1) {
			echo '<div style="width:100%;margin-top:10%;text-align:center;"><img src="../images/home.png"></div>';
		} else {
			if (!$sf_user->hasGroup('Cliente')) include_partial('stock_minimo', array('pager' => $pager));
			if ($sf_user->hasCredential('Pedidos Nuevos')) include_partial('ped_pend', array('pager2' => $pager2));
		}
	} else {
		echo '<div style="width:100%;margin-top:10%;text-align:center;"><img src="../images/home.png"></div>';
	}
?>
</div>