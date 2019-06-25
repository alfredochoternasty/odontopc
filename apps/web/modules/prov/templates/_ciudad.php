<?php
if(is_null($proveedor->getLocalidadId()))
  echo "";
else
  echo $proveedor->getLocalidad();
?>