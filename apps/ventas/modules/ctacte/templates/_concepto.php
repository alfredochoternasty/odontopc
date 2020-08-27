<?php
/*
$obs = $cta_cte->getObservacion();
if(strpos($obs, 'DEV-') === false){
  if($cta_cte->getConcepto() == 'Venta')
    echo '<a href="">Venta Nro '.$cta_cte->getNumero().'</a>';
  else
    echo '<a href="">Cobro Nro '.$cta_cte->getNumero().'</a>';
}else{
  echo '<a href="">Devoluci&oacute;n Nro '.$cta_cte->getNumero().'</a>';
}
*/
if ($cta_cte->concepto == 'Venta') {
	echo Doctrine::getTable('Resumen')->find($cta_cte->numero);
} elseif ($cta_cte->concepto == 'Cobro') {
	echo "RECIBO DE COBRO 0005 - ".str_pad($cta_cte->numero, 8, 0, STR_PAD_LEFT);
} elseif ($cta_cte->concepto == 'Devolución') {
	$cobro = Doctrine::getTable('Cobro')->find($cta_cte->numero);
	echo Doctrine::getTable('DevProducto')->find($cobro->devprod_id);
} else {
	echo $cta_cte->concepto." - #".$cta_cte->getNumero();
}
?>