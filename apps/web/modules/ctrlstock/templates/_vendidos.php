<?php
if(!empty($control_stock->vendidos))
	echo $control_stock->getVendidos();
else 
	echo '0';
?>