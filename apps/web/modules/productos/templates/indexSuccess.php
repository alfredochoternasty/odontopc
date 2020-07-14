<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div style="width:100%; height:40px; background-color:#fff; position:fixed; top:50px; left:0px;border-bottom:1px solid #cccccc;">
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
</div>
<div style="position:fixed; top:90px; height: 100%; overflow: scroll; width:95%; padding:2%;">
<?php foreach ($productos as $producto): ?>
<div style="width:100%; border: 1px solid #cccccc; margin-bottom:1%">
	<table width="100%">
		<tr >
			<?php $foto = empty($producto->foto_chica)? 'no_img.png' : $producto->foto_chica ?>
		  <td width="10%"><?php echo '<img src="'.$base_url.'/web/uploads/productos/'.$foto.'" height="70vw" width="70vw">' ?></td>
		  <td width="55%"><span style="font-size:12pt;font-family:sans-serif;color: #008ddc;font-weight: bold;"><?php echo $producto->getNombre() ?></span>
			<br><span style="font-size:10pt;font-family:sans-serif;color: #e20202;font-weight: bold;">$ <?php echo $producto->getPrecioVta() ?></span>
		  </td>
		  <td width="35%" style="text-align:right">
			<form action="<?php echo url_for('productos/pedir') ?>" onSubmit="return validar(this);">
			  <input name="producto_id" type="hidden" value="<?php echo $producto->getId() ?>">
			  <input name="cantidad" placeholder="Cant." type="number" style="width:30%; border: 1px solid #f4800c; height:14pt; text-align:center;display:inline;">
			  <input type="submit" value="Pedir" class="boton_prod">
			</form>
		  </td>
		</tr>
	</table>
</div>
<?php endforeach; ?>
</div>