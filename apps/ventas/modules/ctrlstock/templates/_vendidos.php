<?php
if(!empty($control_stock->vendidos))
	echo $control_stock->vendidos - $control_stock->cant_dev;
else 
	echo '0';
?>