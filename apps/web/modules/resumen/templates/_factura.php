<?php
	$modulo_factura = $sf_user->getVarConfig('modulo_factura');
	if ($modulo_factura == 'S') {
		if ($resumen->tipofactura_id != 4) {
			if ($resumen->afip_estado > 0)
				echo $resumen->getFactura();
			else
				echo $resumen->getTipoFactura();
		} else {
			echo $resumen->getTipoFactura().' - '.$resumen->nro_factura;
		}
	} else {
		echo $resumen->getTipoFactura().' - '.$resumen->id;
	}
?>