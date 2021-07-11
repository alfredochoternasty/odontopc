<?php
if (!empty($descuento_zona->cliente_id))
  echo $descuento_zona->getCliente();
else if (!empty($descuento_zona->grupoprod_id))
  echo $descuento_zona->getGrupoprod();
else
  echo $descuento_zona->getProducto();
?>