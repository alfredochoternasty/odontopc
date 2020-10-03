<?php 
	echo '$ '.number_format($facturas_afip->tipofactura_id>5?$facturas_afip->iva*-1:$facturas_afip->iva, 2, ',', '.'); 
?>
