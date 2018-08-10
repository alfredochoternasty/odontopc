<?php
if(!empty($control_stock->cant_vendida))
	echo $control_stock->getCantVendida();
else 
	echo '-';
?>