<div style="float:left; width:45%;margin:5px;">
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1>Ventas mes actual comparadas con mismo dia mes anterior</h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">Categoria</th>
			<th class="ui-state-default" style="height:2em;">Actual</th>
			<th class="ui-state-default" style="height:2em;">Mes Anterior</th>
			<th class="ui-state-default" style="height:2em;">Diferencia</th>
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
			foreach ($ventas as $i => $categoria) {
				$odd = fmod(++$i, 2) ? ' odd' : '';
				$actual = $categoria->getCantVendida($zona_id);
				$anterior = $categoria->getCantVendidaAnt($zona_id);
				$porcentaje = ($actual*100/$anterior)-100;
		?>
				<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td class="sf_admin_text"><?php echo $categoria->nombre ?></td>
					<td class="sf_admin_text"><?php echo $actual ?></td>
					<td class="sf_admin_text"><?php echo $anterior ?></td>
					<td class="sf_admin_text" style="font-weight:bold; color:<?php echo ($porcentaje<0)?'#ff4000':'#00b359'; ?>"><?php echo ($porcentaje<0)?'&#9660;':'&#9650;'; ?><?php echo number_format(abs($porcentaje), 2).'%'; ?></td>
				</tr>
		<?php } ?>
	</tbody>
</table>
</div>