<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix" style="float:left; width:45%;margin:5px;">
<table width="100%">
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<h1>Ventas actual comparadas mismo dia mes anterior (<?php echo !empty($zona)? $zona->nombre:'Todas las Zonas' ?>)</h1>
	</caption>

	<thead class="ui-widget-header">
		<tr>
			<th class="ui-state-default" style="height:2em;">Categoria</th>
			<th class="ui-state-default" style="height:2em;">del <?php echo date('01/m').' al '.date('d/m') ?></th>
			<?php 
				$fecha = date_create(date('Y-m-d'));
				date_sub($fecha, date_interval_create_from_date_string('1 month'));
			?>
			<th class="ui-state-default" style="height:2em;">del <?php echo date_format($fecha, '01/m').' al '.date_format($fecha, 'd/m') ?></th>
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
			$id_zona = !empty($zona)? $zona->id:0;
			foreach ($pager->getResults() as $i => $categoria) {
				$odd = fmod(++$i, 2) ? ' odd' : '';
				$actual = $categoria->getCantVendida($id_zona);
				$anterior = $categoria->getCantVendidaAnt($id_zona);
				$porcentaje = $anterior>0?($actual*100/$anterior)-100:0;
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