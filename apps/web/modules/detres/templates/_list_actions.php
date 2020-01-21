<?php 
	$detalle = $pager->getResults();
	if (empty($detalle[0]->getResumen()->afip_estado)) : 
?>
<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<?php endif; ?>
<?php echo link_to(__('Imprimir', array(), 'messages'), 'detres/ListImprimir', array()) ?>
