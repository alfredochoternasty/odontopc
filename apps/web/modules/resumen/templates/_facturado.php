<?php
if($resumen->getVenta()){
  $total = $resumen->getTotalFacturado();
  echo isset($total)? "$ ".$total:"";
}else{
  echo "";
}
?>