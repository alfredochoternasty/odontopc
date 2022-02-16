<?php 
	$detalle = $pager->getResults();
	if (empty($detalle[0]->getResumen()->afip_estado)) echo link_to('Nuevo','detres/new',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;'));
	echo link_to('Imprimir','detres/ListImprimir',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;'));
	if (empty($detalle[0]->getResumen()->afip_estado)) echo link_to('Recalcular Precio','detres/ListRecalcular',array('confirm' => 'Seguro que quiere RECALCULAR??', 'class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;'));
?>