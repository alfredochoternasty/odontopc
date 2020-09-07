<?php 
echo '$ '.sprintf("%01.2f", $listado_ventas->getDetalleResumen()->precio * ($listado_ventas->cantidad));
?>