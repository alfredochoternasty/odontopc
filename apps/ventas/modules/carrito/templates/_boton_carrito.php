<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php if (!empty($sf_user->getAttribute('pid'))): ?>
	<a href="<?php echo url_for('carrito/index', true) ?>" id="boton_arriba_derecha">
		<img id="carrito" src="<?php echo $base_url?>/web/images/shopping-cart.png">
		<?php
			$ped_cant_prods = count(Doctrine::getTable('DetallePedido')->findByPedidoId($sf_user->getAttribute('pid', 0)));
			if (!empty($ped_cant_prods)) echo '<div class="cant_prods">'.$ped_cant_prods.'</div>';
		?>
	</a>
<?php endif; ?>