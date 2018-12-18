<?php
echo $detalle_presupuesto->getPresupuesto()->getLista()->getMoneda()->getSimbolo().' '.sprintf("%01.2f", (($detalle_presupuesto->precio * 0.21) + $detalle_presupuesto->precio) * $detalle_presupuesto->cantidad);
?>