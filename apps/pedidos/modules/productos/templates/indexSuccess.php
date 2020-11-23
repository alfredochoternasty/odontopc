<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="combo_grupos">
		<form id="grupos" action="<?php echo url_for('productos/filtrado') ?>">
			<select name="grupo_id" id="grupo_id">
				<option value="0">Mostrar todos los productos</option>
				<?php foreach ($grupos_prod as $grupo): ?>
				<option value="<?php echo $grupo->id ?>" <?php if($grupo_id == $grupo->id) echo "selected" ?> ><?php echo $grupo->nombre ?></option>
				<?php endforeach; ?>
			</select>
		</form>
</div>
<div id="lista_productos">
<?php foreach ($productos as $producto): ?>
<div class="productos">
	<table width="100%">
		<tr >
		  <td width="10%"><img src="<?php echo url_for('productos/GetImagen?img='.$producto->getImagen()) ?>" height="60vw" width="80vw"></td>
		  <td width="70%">
			<span class="nombre_producto"><?php echo $producto ?></span><br>
			<span class="nombre_grupo"><?php echo $producto->getGrupo() ?></span><br>
			<span class="precio">$ 
				<?php 
					list($precio, $moneda) = explode('##', $producto->getPrecioFinal($lista_id));
					$iva = round($precio * 0.21, 1);
					$total = round($precio + $iva);
					echo sprintf("%01.2f", $total);
				?>
			</span>
		  </td>
		  <td width="70%" style="text-align:center">
			<form action="<?php echo url_for('productos/pedir') ?>" onSubmit="return validar(this);">
			  <input name="producto_id" type="hidden" value="<?php echo $producto->getId() ?>">
			  <input name="cantidad" placeholder="Cant." type="number" class="cant_pedir"><br>
			  <input type="submit" value="Pedir" class="boton_prod">
			</form>
		  </td>
		</tr>
	</table>
</div>
<?php endforeach; ?>
</div>
<?php if (!empty($sf_user->getAttribute('pid'))): ?>
	<div id="notificaciones">
		<a href="<?php echo url_for('carrito/index') ?>"> 
		<div class="boton_azul boton_abajo_1">
			<img src="<?php echo $base_url?>/images/order.png">&nbsp;&nbsp;Confirmar Pedido
		</div>
		</a>	
	</div>
<?php endif; ?>
<?php if (!empty(count($promociones))): ?>
	<div id="promociones">
	<table id="titulo">
		<tr>
			<td>
				<span id="abrir_promo">Promociones Vigentes&nbsp;&nbsp;&nbsp;&nbsp;&#9650;</span>
				<span id="cerrar_promo">Promociones Vigentes&nbsp;&nbsp;&nbsp;&nbsp;&#9660;</span>
			</td>
		</tr>
	</table>
	<?php foreach ($promociones as $promo): ?>
		<div class="promocion">
						<span class="nombre_promo"><?php echo $promo->nombre ?></span><br>
						<span class="promo_detalle"><?php echo $promo->descripcion ?></span><br>
		</div>
	<?php endforeach; ?>
	</div>
<?php endif; ?>