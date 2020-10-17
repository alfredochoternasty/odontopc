<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<div style="text-align:center; margin-top:30px;" class="contenido contenido_boton">
	<h1 class="titulo">Pedido realizado con exito!!</h1>
	<img src="<?php echo $base_url?>/images/party.png"><br>
	<h2 class="fila_primario">Puede ver su pedido en estado pendiente en el men&uacute de pedidos</h2>
	<br>
	<h3 style="margin:1em;color:#ff0000;">Para una mejor organizaci&oacute;n los pedidos se env&iacute;an o se retiran a las 48hs. Muchas gracias por su colaboraci&oacute;n.</h3>
</div>
<a href="<?php echo url_for('@producto2') ?>">
<div class="boton_azul boton_abajo_1">
	<img src="<?php echo $base_url?>/images/implant.png">&nbsp;&nbsp;Inicio
</div>
</a>	