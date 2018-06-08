<?php 
echo $listado_ventas->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $listado_ventas->getTotal());
?>