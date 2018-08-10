<?php
if(!empty($control_stock->stock_actual)) 
	echo $control_stock->getStockActual();
else 
	echo $control_stock->getComprados();
?>