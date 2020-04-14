<?php	$base_url = $sf_user->getVarConfig('base_url'); ?>
<div style="width: 90%; text-align: center; top:100px;position:fixed;margin-left: 5%;">
	<img src="<?php echo $base_url?>/web/images/party.png"><br>
	<p style="font-size: 18pt;font-weight: bold;">Pedido realizado con exito!!</p>
	<p style="font-size: 14pt;">Se le envió un email con la información del pedido.</p>
</div>
<a href="<?php echo url_for('@producto2') ?>">
<div class="boton_finalizar">
	<img src="<?php echo $base_url?>/web/images/implant.png">&nbsp;&nbsp;Inicio
</div>
</a>	