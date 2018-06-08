<?php
echo sprintf($cobro->getMoneda()->getSimbolo()." %01.2f", $cobro->getMonto());
?>