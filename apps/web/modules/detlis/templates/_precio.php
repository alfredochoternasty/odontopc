<?php
$moneda = $det_lis_precio->getLista()->getMoneda()->getSimbolo();
if($det_lis_precio->getPrecio() > 0) echo $moneda.' '.$det_lis_precio->getPrecio();
?>