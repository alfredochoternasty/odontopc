<table>
	<caption class="fg-toolbar ui-widget-header ui-corner-top"><h1>Venta</h1></caption>
	<tbody>
	<tr>
		<td>
			<span style="font-size: 14px;">
				<b><?php echo $resumen->getTipoFactura().' - '.$resumen->id; ?><b><br>
				<b>Fecha: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getFecha()))) ?>
			</span>
		</td>
		<td>
			<span style="font-size: 14px;">
			<b>Cliente: </b><?php echo $resumen->getCliente() ?><br>
			<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
				<b>Condición de Venta : </b>Cuenta Corriente
			<?php endif;?>
			</span>
		</td>
	</tr>
	<?php if (!empty($resumen->observacion)): ?>
	<tr>
		<td colspan="2">
			<span style="font-size: 14px;"><b>Observacion: </b> <?php echo $resumen->getObservacion() ?></span>
		</td>
	</tr>
	<?php endif;?>
	<tr><td colspan="2">&nbsp;</td></tr>		
	</tbody>
</table>