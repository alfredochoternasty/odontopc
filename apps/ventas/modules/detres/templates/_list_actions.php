<?php 
	$detalle = $pager->getResults();
	if (empty($detalle[0]->getResumen()->afip_estado)) : 
?>
<?php echo link_to('Nuevo','detres/new',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;')) ?>
<?php endif; ?>
<?php echo link_to('Imprimir','detres/ListImprimir',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;')) ?>
