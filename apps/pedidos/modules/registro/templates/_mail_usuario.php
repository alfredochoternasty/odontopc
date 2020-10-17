<p>
	Estimado/a <b><?php echo ucwords(strtolower($cliente->apellido)).' '.ucwords(strtolower($cliente->nombre)) ?></b>
	<br>Gracias por registrarte en sistema de pedidos de NTI IMPLANTES.
</p>
<p>
	Ahora puedes ingresar usando los siguientes datos:
	<ul>
		<li><a href="http://pedidos.ntiimplantes.com.ar">http://pedidos.ntiimplantes.com.ar</a></li>
		<li><b>Usuario:</b>&nbsp;&nbsp;<?php echo $cliente->getUsuario()->getUsername() ?></li>
		<li><b>Clave:</b>&nbsp;&nbsp;<?php echo $clave ?></li>
	</ul>
	<br>Recuerda cambiar tu clave.
	<br>Saludos cordiales,
</p>