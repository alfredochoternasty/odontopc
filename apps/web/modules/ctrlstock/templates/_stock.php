<?php
if(!empty($control_stock->stock)) 
	echo $control_stock->getStock();
else 
	echo $control_stock->getCantComprada();
?>