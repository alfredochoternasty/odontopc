<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">		
		<?php 
			if (!empty($detalle_resumen->det_remito_id)) echo link_to('Remito', '@detalle_resumen?rid='.$detalle_resumen->getDetalleRemito()->resumen_id, 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left target="blank"');
			if ($detalle_resumen->getResumen()->afip_estado == 0) echo $helper->linkToDelete($detalle_resumen, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) 
		?>
  </ul>
</td>
