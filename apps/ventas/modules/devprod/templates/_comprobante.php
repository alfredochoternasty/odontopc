<?php 
if ($dev_producto->getResumen()->tipofactura_id != 4) {
	if (!empty($dev_producto->afip_estado)) {
		echo $dev_producto->getTipoFactura().'-'.$dev_producto->pto_vta.'-'.str_pad($dev_producto->nro_factura, 8, '0', STR_PAD_LEFT);
	} else {
		echo 'NO ENVIADA A AFIP';
	}
} else {
	echo $dev_producto->getResumen();
}
?>