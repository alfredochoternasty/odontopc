<?php
if($control_stock->stock_calculado != '' || $control_stock->stock_calculado != null)
	echo $control_stock->getStockCalculado();
else 
	echo $control_stock->getComprados();
?>