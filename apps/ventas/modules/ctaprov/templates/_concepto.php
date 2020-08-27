<?php
$obs = $cta_cte->getObservacion();
if(strpos($obs, 'DEV-') === false){
  if($cta_cte->getConcepto() == 'Venta')
    echo '<a href="">Venta Nro '.$cta_cte->getNumero().'</a>';
  else
    echo '<a href="">Cobro Nro '.$cta_cte->getNumero().'</a>';
}else{
  echo '<a href="">Devoluci&oacute;n Nro '.$cta_cte->getNumero().'</a>';
}
?>