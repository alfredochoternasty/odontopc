<?php
if ($sf_guard_user->es_cliente)
	echo $sf_guard_user->getCliente()->getZona();
else
	echo $sf_guard_user->getZona();
?>