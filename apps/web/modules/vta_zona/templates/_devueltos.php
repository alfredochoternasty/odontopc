<?php
$devueltos = $ventas_zona->getResumen()->getDevueltos();
foreach ($devueltos as $dev) {
	if ($ventas_zona->getDetalleResumen()->producto_id == $dev->producto_id && $ventas_zona->getDetalleResumen()->nro_lote == $dev->nro_lote) {
		
	}
}
?>