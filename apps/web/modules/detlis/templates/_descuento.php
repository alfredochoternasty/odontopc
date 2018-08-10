<?php
if($det_lis_precio->getDescuento() > 0) 
	echo $det_lis_precio->getDescuento().' %';
else 
	echo '';
?>