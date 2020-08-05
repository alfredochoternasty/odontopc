<div style="float:left; width:45%;margin:5px;">
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1>Ventas por Pedido</h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">Ventas</th>
			<th class="ui-state-default" style="height:2em;">Pedidos</th>
			<th class="ui-state-default" style="height:2em;">Porcentaje Pedidos</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th colspan="3">
				<div class="ui-state-default ui-th-column ui-corner-bottom">
					
				</div>
			</th>
		</tr>
	</tfoot>
	
	<tbody>
		<?php 
				$actual = $tipo_ventas['ventas'];
				$anterior = $tipo_ventas['pedidos'];
				$porcentaje = 0;
				if (!empty($anterior)) $porcentaje = ($actual*100/$anterior)-100;
		?>
				<tr class="sf_admin_row ui-widget-content">
					<td class="sf_admin_text"><?php echo $actual ?></td>
					<td class="sf_admin_text"><?php echo $anterior ?></td>
					<td class="sf_admin_text" style="font-weight:bold; color:<?php echo ($porcentaje>=0)?'#ff4000':'#00b359'; ?>"><?php echo ($porcentaje>=0)?'&#9660; ':'&#9650; '; ?><?php echo number_format(abs($porcentaje), 2).'%'; ?></td>
				</tr>
	</tbody>
</table>
</div>