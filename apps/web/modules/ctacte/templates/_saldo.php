<?php
if($hasFilters->offsetExists('cliente_id')){
  $sf_user->setAttribute('saldo', $sf_user->getAttribute('saldo', 0) + $cta_cte->getDebe() - $cta_cte->getHaber());
  $saldo = $sf_user->getAttribute('saldo', 0);
}else{
  $saldo = 0;
}

echo sprintf($cta_cte->getMoneda()->getSimbolo()." %01.2f", $saldo); 
?>