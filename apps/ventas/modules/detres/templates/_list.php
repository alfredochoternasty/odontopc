<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle de la Venta ', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('No result', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>
  <?php else: 
	$detalle = $pager->getResults();
	$resumen = $detalle[0]->getResumen() ?>
<?php
	$modulo_factura = $sf_user->getVarConfig('modulo_factura');
	if ($modulo_factura == 'S') {
		if ($resumen->afip_estado == 0 && $resumen->tipofactura_id != 4 && $resumen->fecha >= '2019-02-01') {
			echo link_to('Enviar AFIP', 'detres/cae?rid='.$detalle[0]->resumen_id, array(
				'confirm' => 'Seguro que quiere ENVIAR A AFIP',
				'class'  => 'fg-button fg-button-mini ui-state-default fg-button-icon-left',
				'style' => 'float: right; margin-top: 10px;'
			));
		}
		include_partial('datos_factura', array('resumen' => $resumen));
	} else {
		if ($resumen->afip_estado == 0) {
			echo link_to('Finalizar Venta', 'detres/cae?rid='.$detalle[0]->resumen_id, array(
				'confirm' => 'Seguro que quiere FINALIZAR LA VENTA',
				'class'  => 'fg-button fg-button-mini ui-state-default fg-button-icon-left',
				'style' => 'float: right; margin-top: 10px;'
			));
		}
		include_partial('datos_venta', array('resumen' => $resumen));
	}
?>
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo 'Detalle' ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <?php include_partial('detres/list_th_tabular', array('sort' => $sort, 'res_tipo_factura' => $resumen->tipofactura_id)) ?>
				<th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php 
      $suma_total = array();
      foreach ($pager->getResults() as $i => $detalle_resumen): 
        $odd = fmod(++$i, 2) ? ' odd' : '';
				$id = $detalle_resumen->moneda_id;
        @$suma_total[$id]['moneda'] = $detalle_resumen->getMoneda();
        @$suma_total[$id]['simbolo'] = $detalle_resumen->SimboloMoneda();
        @$suma_total[$id]['total'] += $detalle_resumen->getTotal();
      ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <?php include_partial('detres/list_td_tabular', array('detalle_resumen' => $detalle_resumen)) ?>
        <?php include_partial('detres/list_td_actions', array('detalle_resumen' => $detalle_resumen, 'helper' => $helper)) ?>
        </tr>
      <?php endforeach; 
			
			if ($resumen->tipofactura_id != 4):
        foreach ($suma_total as $i => $suma): 
			?>
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="<?php echo $sf_user->hasGroup('Blanco')? 9 : 8; ?>" style="text-align: right;" class="sf_admin_text">Total en <?php echo $suma['moneda'] ?>:</td>
        <td class="sf_admin_text">
          <?php echo sprintf($suma['simbolo']." %01.2f", $suma['total']) ?>
        </td>
        <td colspan="2" class="sf_admin_text">&nbsp;</td>
      </tr>
			<?php 
				endforeach; 
			endif;
			?>
    </tbody>
  </table>

  <?php endif; ?>
</div>
