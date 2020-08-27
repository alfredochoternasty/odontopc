<?php
$total_resumen = $detalle_resumen->getResumen()->getTotalResumen();
$total_producto = $detalle_resumen['total'];
if($total_resumen > 0 || $total_producto > 0)
  $porcentaje = round(($total_producto * 100) /$total_resumen, 2);
else
  $porcentaje = 0;
echo "% ".$porcentaje;
?>