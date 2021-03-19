<?php include_partial('global/cabecera_listado', array('titulo' => 'Cobros Realizados', 'configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<table cellspacing="0" border="1px" width="100%">
  <thead>
	<tr>
	  <?php include_partial('cobro/imp_th_tabular') ?>
	</tr>
  </thead>
  <tbody>
	<?php 
		$total = 0;
		foreach ($cobros as $i => $cobro): 
	?>
	  <tr>
		<?php 
			include_partial('cobro/imp_td_tabular', array('cobro' => $cobro));
			$total += $cobro->monto;
		?>
	  </tr>
	<?php endforeach ?>
		<tr style="font-size:14pt;">
			<td colspan="3" style="text-align:right;">Total:&nbsp;</td>
			<td style=" width:150px;"><?php echo '$ '.number_format($total, 2, ',', '.'); ?></td>
			<td colspan="3">&nbsp;</td>
		</tr>
  </tbody>
</table>
<?php include_partial('global/pie_listado') ?>