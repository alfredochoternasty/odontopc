<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('global/boton_volver', array('url' => '@producto2')) ?>
<div class="contenido contenido_boton">
	<h3 class="titulo">Pedido Nro: <?php echo $nro_pedido?></h3>
	<p class="sub_titulo">Total: <b>$ <?php echo $total_pedido ?></p>
	<h4 style="width:100%;text-align:center;color:#ff0000;">Los pedidos se envian o se retiran a las 48hs</h4>
	<?php foreach ($detalle_pedido as $detped): ?>
	<div class="fila_contenido">
		<table width="100%">
			<tr >
				<td width="10%"><img src="<?php echo url_for('productos/GetImagen?img='.$detped->getProducto()->getImagen()) ?>" height="60vw" width="80vw"></td>
				<td width="90%">
					<span class="fila_primario"><?php echo $detped->getProducto()->getNombre() ?></span><br>
					<span class="fila_secundario">$ <?php echo number_format($detped->precio, 2, ',', '.').' x '.$detped->cantidad.' = $ '.number_format($detped->total, 2, ',', '.') ?></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<div style="width:100%; display:flex; justify-content: center; align-items: center;">
						<span style="font-size:10pt;font-family:sans-serif;">Cant.</span>
						<form style="width:40%;" action="<?php echo url_for('carrito/modificar') ?>" onSubmit="return validar(this);">
							<input name="detalle_id" type="hidden" value="<?php echo $detped->getId() ?>">
							<input name="cantidad" type="number" onClick="this.setSelectionRange(0, this.value.length)" style="width:20%; border: 1px solid #f4800c; height:14pt; text-align:center;display:inline;">
							<input type="submit" value="Modificar" class="boton_prod">
						</form>
						<form style="width:10%;" action="<?php echo url_for('carrito/delete') ?>" onSubmit="return confirm('¿Eliminar producto?');">
							<input name="id" type="hidden" value="<?php echo $detped->getId() ?>">
							<input type="submit" value="Borrar" class="boton_prod">
						</form>
				</div>
				</td>
			</tr>
		</table>
	</div>
	<?php endforeach; ?>
</div>

<a href="<?php echo url_for('carrito/confirmar') ?>"> 
<div class="boton_azul boton_abajo_1">
	<img src="<?php echo $base_url?>/images/order.png">&nbsp;&nbsp;Terminar Pedido
</div>
</a>