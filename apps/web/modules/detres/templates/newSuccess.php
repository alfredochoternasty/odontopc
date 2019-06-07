<?php use_helper('I18N', 'Date') ?>
<?php 
	include_partial('detres/assets');
	$resumen = $detalle_resumen->getResumen(); 	
?>
		
<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
	<table width="100%">
		<caption class="fg-toolbar ui-widget-header ui-corner-top">
						<h1>Venta</h1>
		</caption>
		<tbody>
		<tr>
		<td>
			<span style="font-size: 14px;">
				<?php echo $resumen->getTipoFactura(); ?><br>
				<b>Punto de Venta: </b>0004<b style="margin-left: 20px;">Comp. Nro: </b><?php echo str_pad($resumen->getNroFactura(), 8, 0,STR_PAD_LEFT) ?><br>
				<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getFecha()))) ?><br>
				<b>CAE: </b><?php echo $resumen->getAfipCAE() ?><br>
				<b>Fecha Vto CAE: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getAfipVtoCae()))) ?>
			</span>
		</td>
		<td>
			<span style="font-size: 14px;">
			<b>Razón Social: </b><?php echo $resumen->getCliente() ?><br>
			<b>Domicilio: </b><?php echo $resumen->getCliente()->getDomicilio() ?> - <?php echo $resumen->getCliente()->getLocalidad() ?><br>
			<b>C.U.I.T. : </b><?php echo $resumen->getCliente()->getCuit() ?><br>
			<b>Condición frente al I.V.A. : </b><?php echo $resumen->getCliente()->getCondfiscal() ?><br>
			<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
				<b>Condición de Venta : </b>Cuenta Corriente
			<?php endif;?>
			</span>
		</td>
		</tbody>
	</table>
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