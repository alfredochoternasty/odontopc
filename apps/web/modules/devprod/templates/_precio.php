<?php
echo $dev_producto->getResumen()->getLista()->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $dev_producto->getPrecio());
?>