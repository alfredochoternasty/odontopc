<?php echo ($movimiento_producto->cantidad < 0)? Doctrine::getTable('DevProducto')->find($movimiento_producto->id) : $movimiento_producto->getResumen() ?>