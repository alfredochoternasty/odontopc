<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<p style="width: 100%; text-align: center; top:75px;position:fixed;">Seleccione una opción para la entrega</p>
<div class="form_terminar">
	<form id="form_finalizar" style="width:90%;" action="<?php echo url_for('carrito/finalizar') ?>" onSubmit="">
		<input checked="checked" type="radio" name="entrega" id="retiro" value="0"/>
		<label for="retiro">
			<img src="<?php echo $base_url?>/web/images/warehouse.png">Retirar en sucursal<br>Feliciando 345 - Parana (E.R)
		</label>
		<br/>
		<?php foreach ($domicilios as $domicilio): ?>
		<input checked="checked" type="radio" name="entrega" id="envio_<?php echo $domicilio->id?>" value="<?php echo $domicilio->id?>"/>
		<label for="envio_<?php echo $domicilio->id?>">
			<img src="<?php echo $base_url?>/web/images/truck.png">Enviar a <?php echo $domicilio->direccion; ?>
		</label>
		<?php endforeach;
		?>
	</form>
</div>

<a href="<?php echo url_for('carrito/domicilio') ?>">
<div class="boton_otro">
	<img src="<?php echo $base_url?>/web/images/marker.png">&nbsp;&nbsp;Otra Dirección
</div>
</a>	

<a href="#" onclick="document.getElementById('form_finalizar').submit();">
<div class="boton_finalizar">
	<img src="<?php echo $base_url?>/web/images/box_check.png">&nbsp;&nbsp;Confirmar
</div>
</a>	