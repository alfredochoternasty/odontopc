<div style="width:100%; height:35px; background-color:#fff; position:fixed; top:50px; left:0px;border-bottom:1px solid #000;">
	<table width="96%" style="margin:1%;">
		<tr>
			<td width="50%">Pedido Nro: <?php echo $nro_pedido?></td>
			<td width="50%" style="text-align:right;">Total: <b>$ <?php echo $total_pedido ?></b></td>
		</tr>
	</table>
</div>
<?php foreach ($detalle_pedido as $detped): ?>
<div style="width:97%; border: 1px solid #cccccc; margin:1%;">
	<table width="100%">
		<tr >
		  <td width="10%"><img src="/web/uploads/productos/<?php echo $detped->getProducto()->foto_chica ?>" height="70vw" width="70vw"></td>
		  <td width="60%"><span style="font-size:11pt;font-family:sans-serif;color:#008ddc;font-weight: bold;"><?php echo $detped->getProducto()->getNombre() ?></span>
			<br><span style="font-size:9pt;font-family: sans-serif;color #e20202;font-weight: bold;">$ <?php echo $detped->precio.' x '.$detped->cantidad.' = $ '.$detped->total ?></span>
		  </td>
		  <td width="30%">
			<span style="font-size:10pt;font-family:sans-serif;">Cant.</span>
			<form style="display:flex;" action="<?php echo url_for('carrito/modificar') ?>" onSubmit="return validar(this);">
			  <input name="detalle_id" type="hidden" value="<?php echo $detped->getId() ?>">
			  <input name="cantidad" type="number" onClick="this.setSelectionRange(0, this.value.length)" style="width:40%; border: 1px solid #f4800c; height:14pt; text-align:center;display:inline;">
			  <input type="submit" value="Modificar" style="
				display:inline;
				border: none;
				font: normal normal bold 8pt/normal Verdana, Geneva, sans-serif;
				color: #fff;
				background: #f4800c;
				height: 17pt;
				margin-left:4px;
			  ">
			</form>
		  </td>
		</tr>
	</table>
</div>
<?php endforeach; ?>