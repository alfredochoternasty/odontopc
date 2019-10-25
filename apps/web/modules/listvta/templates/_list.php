<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php 
	$ver_solo_totales = $sf_user->getAttribute('totales', false);
	if (count($hasFilters) == 0): 
	?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'listado_ventas_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right ui-state-disabled')) ?></span>
      </div>
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas', array(), 'messages') ?></h1>
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

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'listado_ventas_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <?php 
					if ($ver_solo_totales) { ?>
						<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">Grupo</th>
						<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">Producto</th>
						<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">Cantidad</th>
						<th class="sf_admin_date sf_admin_list_th_fecha ui-state-default ui-th-column">Bonificados</th>
					<?php
					} else {
						include_partial('listvta/list_th_tabular', array('sort' => $sort));
					?>
						<th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
				<?php 
					}
				?>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="<?php echo $ver_solo_totales?5:13; ?>">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php if (!$ver_solo_totales) include_partial('listvta/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
				<?php /*
					if ($hasFilters->count() > 0) {
						echo '<tr><td> Filtro utilizado: ';
						foreach ($configuration->getFormFilterFields($filters) as $name => $field) {
							@$valor = $hasFilters->getRaw($name);
							$tag = $field->getConfig('label');
							$tag = empty($tag)?$name:$tag;							
							if (!empty($valor)) echo $tag.' = '.$valor;
						}
						echo '</td></tr>';
					} */
					
        if ($ver_solo_totales) {
					$suma_total = 0;
					$suma_total_bon = 0;
					$suma_total_dev = 0;
					foreach ($pager->getResults() as $vtas) {
						// $vtas = $pager->getNext();
						//echo $vtas->producto_id.'xx<br>';
						if (empty($ventas[$vtas->producto_id])) {
							$ventas[$vtas->producto_id] = array(
								'grupo' => $vtas->getGrupo(),
								'producto' => $vtas->getProducto(),
								'cantidad' => $vtas->cantidad,
								'bono' => $vtas->bonificados?:0,
								//'dev' => $vtas->cant_dev?:0,
							);
						} else {
							$ventas[$vtas->producto_id]['cantidad'] += $vtas->cantidad;
							$ventas[$vtas->producto_id]['bono'] += $vtas->bonificados;
							//$ventas[$vtas->producto_id]['dev'] += $vtas->cant_dev;
						}
						$suma_total += $vtas->cantidad;
						$suma_total_bon += $vtas->bonificados;
						//$suma_total_dev += $vtas->cant_dev;
					}
					sort($ventas);
					foreach ($ventas as $vta)	{
							?>
							<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
								<td><?php echo $vta['grupo'] ?></td>
								<td><?php echo $vta['producto'] ?></td>
								<td><?php echo $vta['cantidad'] ?></td>
								<td><?php echo $vta['bono'] ?></td>
								<td><?php //echo $vta['dev'] ?></td>
							</tr>
							<?php 
					}				
				?>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td colspan="2" style="text-align: right; font-size:20px;"><b>Subtotal: </b> </td>
            <td style="font-size:20px;"><b><?php echo $suma_total ?></b></td>
            <td style="font-size:20px;"><b><?php echo $suma_total_bon ?></b></td>
            <td style="font-size:20px;"><b><?php //echo $suma_total_dev ?></b></td>
          </tr>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
				<td colspan="5">&nbsp;</td>
          </tr>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td colspan="2" style="text-align: right; font-size:34px;"><b>Total: </b></td>
            <td colspan="3" style="font-size:34px;"><b><?php echo $suma_total + $suma_total_bon //- $suma_total_dev ?></b></td>
          </tr>
				<?php
				} else {
					foreach ($pager->getResults() as $i => $listado_ventas): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
					<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
						<?php include_partial('listvta/list_td_tabular', array('listado_ventas' => $listado_ventas)) ?>
						<?php include_partial('listvta/list_td_actions', array('listado_ventas' => $listado_ventas, 'helper' => $helper)) ?>
					</tr>
					<?php 
					endforeach; 
				}
			?>
    </tbody>
  </table>

  <?php endif; ?>
</div>
