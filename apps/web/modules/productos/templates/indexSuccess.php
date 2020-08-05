<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="combo_grupos">
		<form id="grupos" action="<?php echo url_for('productos/filtrado') ?>">
			<select name="grupo_id" id="grupo_id">
				<option value="-">Mostrar todos los productos</option>
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
		  <td width="10%"><img src="<?php echo $base_url ?>/web/uploads/productos/<?php echo $producto->getFoto() ?>" height="70vw" width="70vw"></td>
		  <td width="60%">
			<span class="nombre_producto"><?php echo $producto ?></span><br>
			<span class="nombre_grupo"><?php echo $producto->getGrupo() ?></span><br>
			<span class="precio">$ <?php echo sprintf("%01.2f", $producto->precio_vta * 1.21) ?></span>
		  </td>
		  <td width="30%" style="text-align:right">
			<form action="<?php echo url_for('productos/pedir') ?>" onSubmit="return validar(this);">
			  <input name="producto_id" type="hidden" value="<?php echo $producto->getId() ?>">
			  <input name="cantidad" placeholder="Cant." type="number" class="cant_pedir">
			  <input type="submit" value="Pedir" class="boton_prod">
			</form>
		  </td>
		</tr>
	</table>
</div>
<?php endforeach; ?>
</div>
<?php if (!empty($promociones)): ?>
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