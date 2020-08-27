<?php 
if (empty($movimiento_producto->bonificados)) {
  echo $movimiento_producto->cantidad;
} else {
  echo $movimiento_producto->cantidad+$movimiento_producto->bonificados.' ('.$movimiento_producto->bonificados.' Bono)';
}
?>