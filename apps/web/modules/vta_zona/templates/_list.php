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
        
        <?php	include_partial('vta_zona/list_th_tabular', array('sort' => $sort)) ?>
				<th class="sf_admin_text sf_admin_list_th_SubTotal ui-state-default ui-th-column">
					<?php echo __('Neto', array(), 'messages') ?>
				</th>				
				<th class="sf_admin_text sf_admin_list_th_Desc ui-state-default ui-th-column">
					<?php echo __('Descuento', array(), 'messages') ?>
				</th>
				<th class="sf_admin_text sf_admin_list_th_Descuento ui-state-default ui-th-column">
					<?php echo __('Total', array(), 'messages') ?>
				</th>
      </tr>
    </thead>

    <tbody>
      <?php 
				$tot_descuento = 0;
				foreach ($pager->getResults() as $i => $ventas_zona): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          
          <?php include_partial('vta_zona/list_td_tabular', array('ventas_zona' => $ventas_zona)) ?>
					
					<td class="sf_admin_text sf_admin_list_td_Subtotal">
						<?php echo sprintf("$ %01.2f", $ventas_zona->getDetalleResumen()->sub_total); ?>					
					</td>
					<td class="sf_admin_text sf_admin_list_td_desc">
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
					<td class="sf_admin_text sf_admin_list_td_Descuento">
						<?php
							if (!empty($ventas_zona->grupo_porc_desc)) {
								$descuento = $ventas_zona->getDetalleResumen()->sub_total * $ventas_zona->grupo_porc_desc / 100;
							} elseif (!empty($ventas_zona->prod_porc_desc)) {
								$descuento = $ventas_zona->getDetalleResumen()->sub_total * $ventas_zona->prod_porc_desc / 100;
							} elseif (!empty($ventas_zona->grupo_precio_desc)) {
								$descuento = $ventas_zona->grupo_precio_desc;
							} elseif (!empty($ventas_zona->prod_precio_desc)) {
								$descuento = $ventas_zona->prod_precio_desc;
							} else {
								$descuento = 0;
							}
							echo sprintf("$ %01.2f", $descuento); 
							$tot_descuento += $descuento
						?>					
					</td>
				</tr>
      <?php endforeach; ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="7" style="font-size:14px; text-align:right;" class="sf_admin_text"><b>Total: </b></td>
					<td class="sf_admin_text"><b style="color:red; font-size:14px;"><?php echo sprintf("$ %01.2f", $tot_descuento); ?></b></td>
				</tr>
    </tbody>

    <tfoot>
      <tr>
        <th colspan="8">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('vta_zona/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>
	</table>		
  <?php endif; ?>
</div>