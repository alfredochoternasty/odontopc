<div style="float:left; width:45%;margin:5px;">
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1>Clientes nuevos comparados con mes anterior</h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">nuevos</th>
			<th class="ui-state-default" style="height:2em;">Mes Anterior</th>
			<th class="ui-state-default" style="height:2em;">Diferencia</th>
			<th class="ui-state-default" style="height:2em;">Total</th>
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
		<?php 
				$nuevos = $clientes['nuevos'];
				$anterior = $clientes['anterior'];
				$total = $clientes['total'];
				$porcentaje = ($nuevos*100/$anterior)-100;
		?>
				<tr class="sf_admin_row ui-widget-content">
					<td class="sf_admin_text"><?php echo $nuevos ?></td>
					<td class="sf_admin_text"><?php echo $anterior ?></td>
					<td class="sf_admin_text" style="font-weight:bold; color:<?php echo ($porcentaje<0)?'#ff4000':'#00b359'; ?>"><?php echo ($porcentaje<0)?'&#9660; ':'&#9650; '; ?><?php echo number_format(abs($porcentaje), 2).'%'; ?></td>
					<td class="sf_admin_text"><?php echo $total ?></td>
				</tr>
	</tbody>
</table>
</div>