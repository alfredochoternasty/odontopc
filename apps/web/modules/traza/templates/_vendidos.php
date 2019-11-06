<?php
    if (empty($producto_traza->devueltos))
      echo $producto_traza->vendidos;
    else 
      echo $producto_traza->vendidos - $producto_traza->devueltos;
?>