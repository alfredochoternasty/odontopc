<td style="white-space: nowrap;">
	<ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">		
		<?php
			$modulo_factura = $sf_user->getVarConfig('modulo_factura');
			
			if (($modulo_factura == 'S' && $resumen->afip_estado == 0) || $modulo_factura == 'N') {
				echo $helper->linkToDelete($resumen, array(  'label' => 'Eliminar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'ui-icon' => '',));
				echo $helper->linkToEdit($resumen, array(  'label' => 'Modificar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'edit',  'ui-icon' => '',));
			}
		?>
		<li class="sf_admin_action_detalle">
			<?php echo link_to('Detalle', 'resumen/ListDetalle?id='.$resumen->id, array('class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left')) ?>
		</li>
		<?php if (!empty($resumen->pedido_id)): ?>
		<li class="sf_admin_action_detalle">
			<?php echo link_to('Pedido', 'detpedidos/index?pid='.$resumen->pedido_id, array('class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left', 'target' => '_blank')) ?>
		</li>
		<?php endif; ?>
		<li class="sf_admin_action_mail">
			<?php echo link_to('Email', 'resumen/ListMail?id='.$resumen->id, array('class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left')) ?>
		</li>		
		<?php 
		if ($modulo_factura == 'S') {
			if ($resumen->afip_estado == 0 && $resumen->tipofactura_id != 4 && $resumen->fecha >= '2019-02-01')
				echo '<li class="sf_admin_action_factura">'.link_to('Enviar AFIP', 'resumen/ListFactura?id='.$resumen->getId(), array('confirm' => 'Seguro que quiere ENVIAR A AFIP', 'class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left')).'</li>';
		} elseif ($resumen->afip_estado == 0) {
			echo '<li class="sf_admin_action_factura">'.link_to('Finalizar', 'resumen/ListFactura?id='.$resumen->getId(), array('confirm' => 'Seguro que quiere FINALIZAR', 'class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left')).'</li>';
		}				
		?>
	</ul>
</td>
