<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="contenido">
	<h3 class="titulo">Pedidos Realizados</h3>
	<?php foreach ($pedidos as $pedido): ?>
		<div style="width:97%; border: 1px solid #cccccc; margin:2%;">
			<a href="<?php echo url_for('ped/detpedido?pid='.$pedido->id) ?>">
			<table width="100%">
				<tr>
					<td>
						<span class="fila_primario">Nro: <?php echo $pedido->id; ?></span><br>
						<span class="fila_secundario"><?php echo implode('/', array_reverse(explode('-', $pedido->fecha))); ?></span>
					</td>
					<td class="precio">$ <?php echo $pedido->getTotal(); ?></td>
					<td width="20%" style="text-align:center;"><img src="<?php echo $base_url?>/web/images/<?php echo ($pedido->vendido)?"tick.png":"time.png" ?>"></td>
				</tr>
			</table>
			</a>
		</div>
<?php endforeach; ?>
</div>