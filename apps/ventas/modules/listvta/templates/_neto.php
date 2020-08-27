<?php 
echo '$ '.sprintf("%01.2f", $listado_ventas->precio * ($listado_ventas->cantidad + $listado_ventas->bonificados));
?>