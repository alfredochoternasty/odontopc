<?php
echo $detalle_resumen->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $detalle_resumen->getPrecio());
?>