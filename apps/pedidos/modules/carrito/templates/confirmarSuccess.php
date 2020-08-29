<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('global/boton_volver', array('url' => '@carrito')) ?>
<div class="contenido contenido_boton">
	<h3 class="titulo">Seleccione una opción para la entrega</h3>
	
	<div class="form_terminar">
		<form id="form_finalizar" style="width:90%;" action="<?php echo url_for('carrito/finalizar') ?>" onSubmit="">
			<input checked="checked" type="radio" name="entrega" id="retiro" value="0"/>
			<label for="retiro">
				<img src="<?php echo $base_url?>/images/warehouse.png">Retirar en sucursal<br>Feliciando 581 - Parana (E.R)
			</label>
			<br/>
			<?php foreach ($domicilios as $domicilio): ?>
			<input checked="checked" type="radio" name="entrega" id="envio_<?php echo $domicilio->id?>" value="<?php echo $domicilio->id?>"/>
			<label for="envio_<?php echo $domicilio->id?>">
				<img src="<?php echo $base_url?>/images/truck.png">Enviar a <?php echo $domicilio->direccion; ?>
			</label>
			<?php endforeach;
			?>
		</form>
	</div>
</div>

<a href="<?php echo url_for('carrito/domicilio') ?>">
<div class="boton_blanco boton_abajo_2">
	<img src="<?php echo $base_url?>/images/marker.png">&nbsp;&nbsp;Otra Dirección
</div>
</a>	

<a href="#" onclick="document.getElementById('form_finalizar').submit();">
<div class="boton_azul boton_abajo_1">
	<img src="<?php echo $base_url?>/images/box_check.png">&nbsp;&nbsp;Confirmar
</div>
</a>	