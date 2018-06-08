<?php
echo $detalle_resumen->getResumen()->getLista()->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $detalle_resumen->getTotal());
?>