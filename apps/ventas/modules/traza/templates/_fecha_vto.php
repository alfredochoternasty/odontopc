<?php
echo !empty($producto_traza->fecha_vto)?implode('/', array_reverse(explode('-', $producto_traza->fecha_vto))):'no tiene';
?>
