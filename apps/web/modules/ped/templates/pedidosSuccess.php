<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div style="position:fixed; top:50px; height: 100%; overflow: scroll; width:99%; font-family: verdana; font-size: small;">
	<p style="font-weight: bold;text-align: center;color: #d90036;">Pedidos Realizados</p>
	<?php foreach ($pedidos as $pedido): ?>
		<div style="width:97%; border: 1px solid #cccccc; margin:2%;">
			<a href="<?php echo url_for('ped/detpedido?pid='.$pedido->id) ?>">
			<table width="100%">
				<tr>
					<td>
						<span style="font-weight: bold;text-align: center;color: #b9b9c8;">Nro:</span> <span style="font-weight: bold; color: #2693ff;"><?php echo $pedido->id; ?></span><br>
						<span style="font-weight: bold;text-align: center;color: #b9b9c8;">Fecha: </span><span style="font-weight: bold; color: #2693ff;"><?php echo implode('/', array_reverse(explode('-', $pedido->fecha))); ?></span>
						&nbsp;&nbsp;&nbsp;<span style="font-weight: bold;text-align: center;color: #b9b9c8;">Total: </span><span  style="font-weight: bold; color: #2693ff;">$ <?php echo $pedido->getTotal(); ?></span>
					</td>
					<?php 
					if ($pedido->vendido) {
						$img = "tick.png";
					} else {
						$img = "time.png";
					}
					?>
					<td><img src="<?php echo $base_url?>/web/images/<?php echo $img ?>"></td>
				</tr>
			</table>
			</a>
		</div>
<?php endforeach; ?>
</div>