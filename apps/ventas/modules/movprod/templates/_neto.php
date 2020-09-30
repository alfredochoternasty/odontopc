<?php 
echo '$ '.sprintf("%01.2f", $movimiento_producto->getDetalleResumen()->precio * abs($movimiento_producto->cantidad));
?>