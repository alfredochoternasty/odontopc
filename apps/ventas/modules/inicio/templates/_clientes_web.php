<div style="float:left; width:45%;margin:5px;">
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1>Nuevos Clientes</h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">DNI</th>
			<th class="ui-state-default" style="height:2em;">Apellido</th>
			<th class="ui-state-default" style="height:2em;">Nombres</th>
			<th class="ui-state-default" style="height:2em;"></th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th colspan="4">
				<div class="ui-state-default ui-th-column ui-corner-bottom">
					
				</div>
			</th>
		</tr>
	</tfoot>
	
	<tbody>
		<?php foreach ($clientes['web'] as $cliente):	?>
				<tr class="sf_admin_row ui-widget-content">
					<td class="sf_admin_text"><?php echo $cliente->dni ?></td>
					<td class="sf_admin_text"><?php echo $cliente->apellido ?></td>
					<td class="sf_admin_text"><?php echo $cliente->nombre ?></td>
					<td class="sf_admin_text"><?php echo $helper->linkToEdit($cliente, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'edit',  'label' => 'Edit',  'ui-icon' => '',)) ?></td>
				</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>