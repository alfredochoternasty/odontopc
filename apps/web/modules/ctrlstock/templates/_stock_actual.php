<?php
if($control_stock->stock_actual != '' || $control_stock->stock_actual != null)
	echo $control_stock->getStockActual();
else 
	echo $control_stock->getComprados();
?>