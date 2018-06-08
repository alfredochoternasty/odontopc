<?php
$iva = $detalle_resumen->getObservacion();
if(!empty($iva)) $iva .= " - ";
echo  $iva.$detalle_resumen->getProducto();
?>