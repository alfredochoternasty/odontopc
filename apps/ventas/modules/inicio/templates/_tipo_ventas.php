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
				$ventas = $tipo_ventas['ventas'];
				$pedidos = $tipo_ventas['pedidos'];
				$porcentaje = 0;
				if (!empty($pedidos)) $porcentaje = ($pedidos*100/$ventas);
		?>
				<tr class="sf_admin_row ui-widget-content">
					<td class="sf_admin_text"><?php echo $ventas ?></td>
					<td class="sf_admin_text"><?php echo $pedidos ?></td>
					<td class="sf_admin_text" style="font-weight:bold; color:<?php echo ($porcentaje<50)?'#ff4000':'#00b359'; ?>"><?php echo number_format(abs($porcentaje), 2).'%'; ?></td>
				</tr>
	</tbody>
</table>
</div>