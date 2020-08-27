<?php
echo sprintf($fact_compra->getMoneda()->getSimbolo()." %01.2f", $fact_compra->getTotalFactura());
?>
