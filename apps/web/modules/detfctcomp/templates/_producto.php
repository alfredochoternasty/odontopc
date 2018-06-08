<?php
if($det_fact_compra->getProductoId() == '')
  echo $det_fact_compra->getGrupoprod();
else
  echo $det_fact_compra->getProducto();
?>