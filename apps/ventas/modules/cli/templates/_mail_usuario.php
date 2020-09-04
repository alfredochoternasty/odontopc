<p>Hola <b><?php echo $cliente->getApellido().' '.$cliente->getNombre() ?></b>, te enviamos el Usuario y la clave para ingresar al sistema de pedidos de NTI IMPLANTES</p>
<p>
	<ul>
		<li><a href="https://pedidos.ntiimplantes.com.ar">https://pedidos.ntiimplantes.com.ar</a></li>
		<li><b>Usuario:</b>&nbsp;&nbsp;<?php echo $cliente->cuit ?></li>
		<li><b>Clave:</b>&nbsp;&nbsp;<?php echo $clave ?></li>
	</ul>
	<b>Para mayor seguridad cambie la clave.</b>
</p>