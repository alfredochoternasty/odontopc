<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php 
	if (count($hasFilters) == 0): 
	?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'movimiento_producto_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right ui-state-disabled')) ?></span>
      </div>
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas, Ventas de Remitos y Remitos', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('No result', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>

  <?php else: ?>
  <?php
    if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters))
	?>
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'movimiento_producto_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas, Ventas de Remitos y Remitos', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <?php 
						include_partial('movprod/list_th_tabular', array('sort' => $sort));
					?>
						<th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="13">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('movprod/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
				<?php
					foreach ($pager->getResults() as $i => $movimiento_producto): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
					<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
						<?php include_partial('movprod/list_td_tabular', array('movimiento_producto' => $movimiento_producto)) ?>
						<?php include_partial('movprod/list_td_actions', array('movimiento_producto' => $movimiento_producto, 'helper' => $helper)) ?>
					</tr>
					<?php 
					endforeach;
				?>
				<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="6"></td>
					<td><span style="font-size:20px;font-weight:bold;">
					<?php
						$cantidad = 0;
						foreach ($pager->getResults() as $i => $movimiento_producto) $cantidad += $movimiento_producto->cantidad;
						echo $cantidad;
					?>
					</span></td>
					<td colspan="6"></td>
				</tr>
    </tbody>
  </table>

  <?php endif; ?>
</div>
