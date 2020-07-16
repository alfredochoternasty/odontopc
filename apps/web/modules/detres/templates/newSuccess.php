<?php use_helper('I18N', 'Date') ?>
<?php 
	include_partial('detres/assets');
	$resumen = $detalle_resumen->getResumen(); 	
?>
		
<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
	<?php include_partial('datos_factura', array('resumen' => $resumen)); ?>
	<br>
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo Detalle', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('detres/flashes') ?>
  
  <div id="sf_admin_header">
		<?php include_partial('detres/form_header', array('detalle_resumen' => $detalle_resumen, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detres/form', array('detalle_resumen' => $detalle_resumen, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    
    <?php
      if(count($pager2) > 0):
        include_partial('detres/detalle', array('pager2' => $pager2, 'sort' => array('producto', 'asc'), 'helper' => $helper));
      endif;
    ?>
    
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detres/form_footer', array('detalle_resumen' => $detalle_resumen, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

</div>