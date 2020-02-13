<div style="width:100%; height:40px; background-color:#fff; position:fixed; top:50px; left:0px;">
	<!--
	<div class="combo_orden">
		<form>
			<select>
				<option value="nombre">Nombre</option>
				<option value="mas_vendidos">Mas Vendidos</option>
			</select>
		</form>
	</div>
	-->
	<div class="combo_grupos">
		<form id="grupos" action="<?php url_for('@producto2') ?>">
			<select name="grupo_id" id="grupo_id">
				<option value="">Mostrar todos los productos</option>
				<?php foreach ($grupos_prod as $grupo): ?>
				<option value="<?php echo $grupo->id ?>" <?php if($grupo_id == $grupo->id) echo "selected" ?> ><?php echo $grupo->nombre ?></option>
				<?php endforeach; ?>
			</select>
		</form>
	</div>
	<!--
	<div style="margin-top:7px;">
		<form style="display:flex; margin-left:25%;">
			<input name="buscar" type="search" placeholder="buscar..." style="border:1px solid #2982F3; font-size:12pt; width:80%;">
			<button type="submit" style="background:#2982F3; border:none; padding:4px; width:35px;"><img src="/web/images/lupa_b.png"></button>
		</form>
	</div>
	-->
</div>
<?php foreach ($productos as $producto): ?>
<div style="width:97%; border: 1px solid #cccccc; margin:1%;">
	<table width="100%">
		<tr >
		  <td width="10%"><?php echo '<img src="/web/uploads/productos/'.$producto->foto_chica.'" height="70vw" width="70vw">' ?></td>
		  <td width="60%"><span style="font-size:11pt;font-family:sans-serif;color: #008ddc;font-weight: bold;"><?php echo $producto->getNombre() ?></span>
			<br><span style="font-size:9pt;font-family:sans-serif;color: #e20202;font-weight: bold;">$ <?php echo $producto->getPrecioVta() ?></span>
		  </td>
		  <td width="25%">
			<span style="font-size:10pt;font-family:sans-serif;">Cant.</span>
			<form style="display:flex;" action="productos/pedir" onSubmit="return validar(this);">
			  <input name="producto_id" type="hidden" value="<?php echo $producto->getId() ?>">
			  <input name="cantidad" type="number" style="width:30%; border: 1px solid #f4800c; height:14pt; text-align:center;display:inline;">
			  <input type="submit" value="Pedir" style="
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