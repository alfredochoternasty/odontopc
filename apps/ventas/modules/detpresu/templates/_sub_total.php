<?php
echo $detalle_presupuesto->getPresupuesto()->getLista()->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $detalle_presupuesto->sub_total);
?>