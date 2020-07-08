<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
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
		  <td width="10%"><img src="<?php echo $base_url?>/web/uploads/productos/<?php echo $detped->getProducto()->foto_chica ?>" height="50vw" width="50vw"></td>
		  <td width="90%"><span style="font-size:12pt;font-family:sans-serif;color:#008ddc;font-weight: bold;"><?php echo $detped->getProducto()->getNombre() ?></span>
				<br><span style="font-size:10pt;font-family: sans-serif;color: #e20202;font-weight: bold;">$ <?php echo $detped->precio.' x '.$detped->cantidad.' = $ '.$detped->total ?></span>
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