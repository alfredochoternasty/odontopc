<?php
echo $detalle_pedido->getPedido()->getCliente()->getLista()->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $detalle_pedido->getPrecio());
?>