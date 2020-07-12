<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<div class="contenido contenido_boton">
	<h3 class="titulo">Cargar dirección</h3>
	<div class="form_terminar">
		<form id="form_finalizar" style="width:90%; text-align:center;" action="<?php echo url_for('carrito/domiagr') ?>" onSubmit="">
			<br>
			<textarea name="domicilio" cols="40" rows="5"></textarea><br>
			<br>
		</form>
	</div>
</div>

<a href="<?php echo url_for('carrito/confirmar') ?>"> 
<div class="boton_blanco boton_abajo_2">
	<img src="<?php echo $base_url?>/web/images/back_celeste.png">&nbsp;&nbsp;Volver
</div>
</a>	
<a href="#" onclick="document.getElementById('form_finalizar').submit();">
<div class="boton_azul boton_abajo_1">
	<img src="<?php echo $base_url?>/web/images/gps.png">&nbsp;&nbsp;Aceptar
</div>
</a>	