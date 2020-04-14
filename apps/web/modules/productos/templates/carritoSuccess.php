<?php foreach ($detalle_pedido as $detped): ?>
<div style="width:97%; border: 1px solid #cccccc; margin:1%;">
	<table width="100%">
		<tr >
		  <td width="10%"><img src="/web/uploads/productos/<?php echo $detped->getProducto()->foto_chica ?>" height="70vw" width="70vw"></td>
		  <td width="60%"><span style="font-size:10pt;font-family: sans-serif;color: #008ddc;font-weight: bold;"><?php echo $detped->getProducto()->getNombre() ?></span>
			<br><span style="font-size:8pt;font-family: sans-serif;color: #e20202;font-weight: bold;"><?php echo $detped->precio.' x '.$detped->cantidad.' = '.$detped->total ?></span>
		  </td>
		  <td width="25%">
			<div style="display:flex; justify-content: center; align-items: center;">
				<form action="productos/modificar" onSubmit="return validar(this);">
					<input name="detalle_id" type="hidden" value="<?php echo $detped->getId() ?>">
					<input name="cantidad" type="number" value="<?php echo $detped->cantidad ?>" style="width:30%; border: 1px solid #f4800c; height:14pt; text-align:center;display:inline;">
					<input type="submit" value="Modificar" class="boton_prod">
				</form>
			</div>
		  </td>
		</tr>
	</table>
</div>
<?php endforeach; ?>