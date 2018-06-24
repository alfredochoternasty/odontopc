<?php 
$saldo = str_replace(',', '', $cliente_saldo->getSaldo());
$color = $saldo > 3000 ? ' style="font-weight:bold; color:#f00"' : '';

echo '<span '.$color.'>'.$cliente_saldo->getSimbolo() .' '. $cliente_saldo->getSaldo().'</span>'; 
?>
