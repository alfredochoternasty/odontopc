<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="contenido contenido_boton">
	<h3 class="titulo">Pedido Nro: <?php echo $nro_pedido?></h3>
	<p style="text-align:center;" class="precio">Total: <b>$ <?php echo $total_pedido ?></p>
	<?php foreach ($detalle_pedido as $detped): ?>
	<div class="fila_contenido">
		<table width="100%">
			<tr >
				<td width="10%"><img src="<?php echo $base_url?>/web/uploads/productos/<?php echo $detped->getProducto()->foto_chica ?>" height="50vw" width="50vw"></td>
				<td width="90%"> 
					<span class="fila_primario"><?php echo $detped->getProducto()->getNombre() ?></span><br>
					<span class="fila_secundario">$ <?php echo number_format($detped->precio * 1.21, 2, ',', '.').' x '.$detped->cantidad.' = $ '.number_format($detped->total * 1.21, 2, ',', '.') ?></span>
				</td>
			</tr>
		</table>
	</div>
	<?php endforeach; ?>
</div>

<a href="<?php echo url_for('ped/pedidos') ?>"> 
<div class="boton_blanco boton_abajo_1">
	<img src="<?php echo $base_url?>/web/images/back_celeste.png">&nbsp;&nbsp;Volver
</div>
</a>	