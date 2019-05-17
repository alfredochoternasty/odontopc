<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php //if (!$pager->getNbResults()): ?>
  <?php if (count($hasFilters) == 0): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'ventas_zona_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Ventas por Zona', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('Debe elegir un filtro', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>

  <?php else: ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'ventas_zona_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Ventas por Zona', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
				<th id="sf_admin_list_batch_actions"  class="ui-state-default ui-th-column">
					<input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" />
				</th>
        <?php	include_partial('vta_zona/list_th_tabular', array('sort' => $sort)) ?>
				<th class="sf_admin_text ui-state-default ui-th-column">
					<?php echo __('Devueltos', array(), 'messages') ?>
				</th>
				<th class="sf_admin_text ui-state-default ui-th-column">
					<?php echo __('Descuento', array(), 'messages') ?>
				</th>
				<th class="sf_admin_text ui-state-default ui-th-column">
					<?php echo __('Total', array(), 'messages') ?>
				</th>
      </tr>
    </thead>

    <tbody>
      <?php 
				$tot_descuento = 0;
				$zona_id = 0;
				foreach ($pager->getResults() as $i => $ventas_zona): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<?php include_partial('vta_zona/list_td_batch_actions', array('ventas_zona' => $ventas_zona, 'helper' => $helper)) ?>
          
          <?php 
						include_partial('vta_zona/list_td_tabular', array('ventas_zona' => $ventas_zona));
						
						$devueltos = $ventas_zona->getResumen()->getDevueltos();
						$total_dev = 0;
						foreach ($devueltos as $dev) {
							if ($ventas_zona->getDetalleResumen()->producto_id == $dev->producto_id && $ventas_zona->getDetalleResumen()->nro_lote == $dev->nro_lote) {
								$total_dev = $dev->cantidad;
							}
						}
					?>
					
					<td class="sf_admin_text">
						<?php echo empty($total_dev)?'':$total_dev; ?>
					</td>
					<td class="sf_admin_text">
						<?php 
							if (!empty($ventas_zona->grupo_porc_desc)) {
								$descuento = sprintf("%01.2f", $ventas_zona->grupo_porc_desc)." %";
							} elseif (!empty($ventas_zona->prod_porc_desc)) {
								$descuento = sprintf("%01.2f", $ventas_zona->prod_porc_desc)." %";
							} elseif (!empty($ventas_zona->grupo_precio_desc)) {
								$descuento = sprintf("$ %01.2f", $ventas_zona->grupo_precio_desc);
							} elseif (!empty($ventas_zona->prod_precio_desc)) {
								$descuento = sprintf("$ %01.2f", $ventas_zona->prod_precio_desc);
							} else {
								$descuento = '';
							}
							echo $descuento;
					?>
					</td>					
					<td class="sf_admin_text">
						<?php
							$plata_devuelta = $ventas_zona->getDetalleResumen()->precio * $total_dev;
							if (!empty($ventas_zona->grupo_porc_desc)) {
								$descuento = ($ventas_zona->getDetalleResumen()->sub_total - $plata_devuelta) * $ventas_zona->grupo_porc_desc / 100;
							} elseif (!empty($ventas_zona->prod_porc_desc)) {
								$descuento = ($ventas_zona->getDetalleResumen()->sub_total - $plata_devuelta)  * $ventas_zona->prod_porc_desc / 100;
							} elseif (!empty($ventas_zona->grupo_precio_desc)) {
								$descuento = $ventas_zona->grupo_precio_desc;
							} elseif (!empty($ventas_zona->prod_precio_desc)) {
								$descuento = $ventas_zona->prod_precio_desc;
							} else {
								$descuento = 0;
							}
							echo sprintf("$ %01.2f", $descuento); 
							$tot_descuento += $descuento;
							$zona_id = $ventas_zona->zona_id;
						?>					
					</td>
				</tr>
      <?php endforeach; 
				$sf_user->setAttribute('comision_total', $tot_descuento);
				$sf_user->setAttribute('comision_zona', $zona_id);
			?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="16" style="font-size:14px; text-align:right;" class="sf_admin_text"><b>Total: </b></td>
					<td class="sf_admin_text"><b style="color:red; font-size:14px;"><?php echo sprintf("$ %01.2f", $tot_descuento); ?></b></td>
				</tr>
    </tbody>

    <tfoot>
      <tr>
        <th colspan="17">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('vta_zona/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>
	</table>		
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>