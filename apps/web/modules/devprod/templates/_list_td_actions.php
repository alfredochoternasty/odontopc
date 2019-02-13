<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
		<?php 
		echo link_to('Ver Fact.', '@detalle_resumen?rid='.$dev_producto->resumen_id, 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left target="blank"');
		$entorno = sfConfig::get('sf_environment'); 
		if ($dev_producto->afip_estado == 0 ) echo $helper->linkToDelete($dev_producto, array(  'label' => 'Eliminar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'ui-icon' => '',)); 
		if ($entorno != 'dev' && $dev_producto->afip_estado == 0  && $dev_producto->fecha >= '2019-02-01') { ?>
			<li class="sf_admin_action_factura">
				 <?php echo link_to('Enviar AFIP', 'devprod/ListFactura?id='.$dev_producto->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
			</li>
		<?php }
		if ($dev_producto->afip_estado == 1) { ?>
			<li class="sf_admin_action_imprimir">
				<?php echo link_to('Imprimir', 'devprod/ListImprimir?id='.$dev_producto->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
			</li>
		<?php } ?>
  </ul>
</td>
