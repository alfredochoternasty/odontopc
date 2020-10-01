<div style="float:left; width:45%;margin:5px;">
  <div class="sf_admin_flashes ui-widget">
    <div class="notice ui-state-highlight ui-corner-all">
      <span class="ui-icon ui-icon-info floatleft"></span>&nbsp;
      <?php echo __('Se cuentan las ventas, las ventas asociadas a un remito y las devoluciones que no sean asociadas a un remito', array(), 'sf_admin') ?>
    </div>
  </div>
<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top">
		<?php
			$titulo = $zona_id==1?'<span style="color:#fff700">(Todas las Zonas)</span>':'actuales';
		?>
		<h1>Ventas <?php echo $titulo ?> comparadas al mismo dia mes anterior</h1>
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
			foreach ($ventas as $i => $categoria) {
				$odd = fmod(++$i, 2) ? ' odd' : '';
				$zid = $zona_id==1?0:$zona_id;
				$actual = $categoria->getCantVendida($zid);
				$anterior = $categoria->getCantVendidaAnt($zid);
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
<?php if ($zona_id == 1): ?>
<div class="sf_admin_actions_block">
	<?php echo link_to('Ver Historico', 'catprod/ListVerHistorico', array('target'=>'blank', 'class'=>'fg-button fg-button-mini ui-state-default fg-button-icon-left')); ?>
</div>
<?php endif; ?>
</div>