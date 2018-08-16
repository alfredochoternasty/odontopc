<?php
if($control_stock->vendidos != '' || $control_stock->vendidos != null)
	echo $control_stock->getVendidos();
else 
	echo '0';
?>