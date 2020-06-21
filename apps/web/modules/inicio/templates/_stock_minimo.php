<div style="position:absolute;top:0; right:0; width:45%;">
<div class="sf_admin_actions_block floatleft">
	<a tabindex="0" href="#sf_admin_actions_menu" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="sf_admin_actions_button">
		<span class="ui-icon ui-icon-triangle-1-s"></span>
		<?php echo __('Actions', array(), 'sf_admin') ?>
	</a>
	<div id="sf_admin_actions_menu" class="ui-helper-hidden fg-menu fg-menu-has-icons">
		<ul class="sf_admin_actions" id="sf_admin_actions_menu_list">
			<?php echo link_to(__('Imprimir', array(), 'messages'), 'inicio/ListImprimirStockMinimo', array()) ?>
		</ul>
	</div>
</div>
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1><?php echo __('Productos con Stock por debajo del Mínimo', array(), 'messages') ?></h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">Nombre</th>
			<th class="ui-state-default" style="height:2em;">Actual</th>
			<th class="ui-state-default" style="height:2em;">Minimo</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th colspan="3">
				<div class="ui-state-default ui-th-column ui-corner-bottom">
					<?php include_partial('inicio/pagination', array('pager' => $pager)) ?>
				</div>
			</th>
		</tr>
	</tfoot>
	
	<tbody>
		<?php 
			foreach ($pager->getResults() as $i => $producto) {
				$odd = fmod(++$i, 2) ? ' odd' : '' ?>
				<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td class="sf_admin_text sf_admin_list_td_nombre"><?php echo $producto['nombre'] ?></td>
					<td class="sf_admin_text sf_admin_list_td_stock_actual"><?php echo $producto['stock'] ?></td>
					<td class="sf_admin_text sf_admin_list_td_minimo_stock"><?php echo $producto->getMinimoStock() ?></td>
				</tr>
		<?php } ?>
	</tbody>
</table>
</div>