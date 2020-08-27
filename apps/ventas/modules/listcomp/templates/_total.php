<?php 
echo $listado_compras->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $listado_compras->getTotal());
?>