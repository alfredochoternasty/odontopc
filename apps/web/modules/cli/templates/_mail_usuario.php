<p>Hola <b><?php echo $cliente->getApellido().' '.$cliente->getNombre() ?></b>, te enviamos el Usuario y la clave para ingresar al sistema de pedidos de NTI IMPLANTES</p>
<p>
	<ul>
		<li><a href="http://ventas.ntiimplantes.com.ar/web">http://ventas.ntiimplantes.com.ar/web</a></li>
		<li><b>Usuario:</b>&nbsp;&nbsp;<?php echo $cliente->getUsuario()->getUsername() ?></li>
		<li><b>Clave:</b>&nbsp;&nbsp;abc123456</li>
	</ul>
	Recuerde cambiar su clave.
</p>