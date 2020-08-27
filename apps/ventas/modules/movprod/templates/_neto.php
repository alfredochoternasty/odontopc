<?php 
echo '$ '.sprintf("%01.2f", $movimiento_producto->precio * ($movimiento_producto->cantidad + $movimiento_producto->bonificados));
?>