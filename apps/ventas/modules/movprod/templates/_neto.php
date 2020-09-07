<?php 
echo '$ '.sprintf("%01.2f", $movimiento_producto->getDetalleResumen()->precio * ($movimiento_producto->cantidad));
?>