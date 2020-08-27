<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
	<table>
		<caption class="fg-toolbar ui-widget-header">
			<h1><span class="ui-icon"></span>Detalle del Presupuesto</h1>
		</caption>    
		<thead class="ui-widget-header">
			<tr>
				<?php include_partial('detpresu/list_th_tabular', array('sort' => ' ')) ?>
				<th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column">Acciones</th>
			</tr>
		</thead>          
	<tbody>
	<?php foreach($presupuesto_detalle as $detalle): ?>
		<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
		<?php include_partial('detpresu/list_td_tabular', array('detalle_presupuesto' => $detalle)) ?>
		<?php include_partial('detpresu/list_td_actions', array('detalle_presupuesto' => $detalle, 'helper' => $helper)) ?>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>