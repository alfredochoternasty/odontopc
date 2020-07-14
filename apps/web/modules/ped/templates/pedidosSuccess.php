<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="contenido">
	<h3 class="titulo">Pedidos Realizados</h3>
	<?php 
		if (count($pedidos) > 0):
			foreach ($pedidos as $pedido): ?>
				<div class="fila_contenido">
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
	<?php 
			endforeach; 
		else:
	?>
		<div class="fila_contenido fila_primario" style="width:93%; text-align:center; padding:2%;">No hay datos</div>
	<?php	
		endif;
	?>
</div>