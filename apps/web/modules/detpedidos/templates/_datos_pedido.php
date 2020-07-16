<table style="width:100%">
	<caption class="fg-toolbar ui-widget-header ui-corner-top"><h1>Datos</h1></caption>
	<tbody>
	<tr>
		<td>
			<span style="font-size: 14px;">
				<b>Pedido Nro : <?php echo $pedido->id; ?><b><br>
				<b>Fecha de Pedido: </b><?php echo implode('/', array_reverse(explode('-', $pedido->fecha))) ?><br>
			</span>
		</td>
		<td>
			<span style="font-size: 14px;">
				<b>Cliente: </b><?php echo $pedido->getCliente() ?><br>
				<b>Direcci&oacute;n de Entrega : </b><?php echo $pedido->direccion_entrega ?><br>
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