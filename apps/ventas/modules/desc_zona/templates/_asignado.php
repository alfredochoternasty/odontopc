<?php
if (!empty($descuento_zona->cliente_id))
  echo 'Cliente';
else if (!empty($descuento_zona->grupoprod_id))
  echo 'Grupo';
else
  echo 'Producto';
?>