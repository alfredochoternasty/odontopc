<?php 
	echo '$ '.number_format($facturas_afip->tipofactura_id>5?$facturas_afip->total*-1:$facturas_afip->total, 2, ',', '.'); 
?>