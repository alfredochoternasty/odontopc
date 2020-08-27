<?php
if($detalle_resumen->getProducto()->getCtrFactGrupo()){
  $CantComprada = $detalle_resumen->getProducto()->getGrupo()->CantidadComprada();
  $CantFacturada = $detalle_resumen->getProducto()->getGrupo()->CantidadFacturada();
}else{
  $CantComprada = $detalle_resumen->getProducto()->CantidadComprada();
  $CantFacturada = $detalle_resumen->getProducto()->CantidadFacturada();
}

if(($CantComprada - $CantFacturada) >= 0)
  echo "Si";
else
  echo "NO";
?>