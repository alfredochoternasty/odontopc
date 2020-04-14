<div style="width:100%; height:35px; background-color:#fff; position:fixed; top:50px; left:0px; border-bottom:1px solid #cccccc;">
	<table width="96%" style="margin:1%;">
		<tr>
			<td width="50%">Pedido Nro: <?php echo $nro_pedido?></td>
			<td width="50%" style="text-align:right;">Total: <b>$ <?php echo $total_pedido ?></b></td>
		</tr>
	</table>
</div>
<div style="position: absolute; top: 90px; overflow-y: scroll; height:73%; padding:5px;">
<?php foreach ($detalle_pedido as $detped): ?>
<div style="width:96%; border: 1px solid #cccccc; margin:2%;">
	<table width="100%">
		<tr >
		  <td width="10%"><img src="/web/uploads/productos/<?php echo $detped->getProducto()->foto_chica ?>" height="50vw" width="50vw"></td>
		  <td width="90%"><span style="font-size:12pt;font-family:sans-serif;color:#008ddc;font-weight: bold;"><?php echo $detped->getProducto()->getNombre() ?></span>
				<br><span style="font-size:10pt;font-family: sans-serif;color: #e20202;font-weight: bold;">$ <?php echo $detped->precio.' x '.$detped->cantidad.' = $ '.$detped->total ?></span>
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
<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<a href="<?php echo url_for('carrito/confirmar') ?>"> 
<div class="boton_finalizar">
	<img src="<?php echo $base_url?>/web/images/order.png">&nbsp;&nbsp;Confirmar Pedido
</div>
</a>