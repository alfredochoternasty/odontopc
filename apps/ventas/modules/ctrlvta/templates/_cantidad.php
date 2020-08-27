<?php 
if (empty($listado_ventas->bonificados)) {
  echo $listado_ventas->cantidad;
} else {
  echo $listado_ventas->cantidad+$listado_ventas->bonificados.' ('.$listado_ventas->bonificados.' Bono)';
}
?>