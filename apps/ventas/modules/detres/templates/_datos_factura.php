<table style="width:100%">
	<caption class="fg-toolbar ui-widget-header ui-corner-top"><h1>Datos</h1></caption>
	<tbody>
	<tr>
		<td>
			<span style="font-size: 14px;">
				<b><?php echo $resumen->getTipoFactura(); ?><b><br>
				<b>Punto de Venta: </b><?php echo str_pad($resumen->getPtoVta(), 4, 0,STR_PAD_LEFT) ?><b style="margin-left: 20px;">Comp. Nro: </b><?php echo str_pad($resumen->getNroFactura(), 8, 0,STR_PAD_LEFT) ?><br>
				<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getFecha()))) ?><br>
				<?php if ($resumen->tipofactura_id != 4 ) { ?>
					<b>CAE: </b><?php echo $resumen->getAfipCae() ?><br>
					<b>Fecha Vto CAE: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getAfipVtoCae()))) ?>
				<?php } ?>
				<br>
			</span>
		</td>
		<td>
			<span style="font-size: 14px;">
			<b>Razón Social: </b><?php echo $resumen->getCliente() ?><br>
			<b>Domicilio: </b><?php echo $resumen->getCliente()->getDomicilio() ?> - <?php echo $resumen->getCliente()->getLocalidad() ?><br>
			<b>C.U.I.T. : </b><?php echo $resumen->getCliente()->getCuit() ?><br>
			<b>Condición frente al I.V.A. : </b><?php echo $resumen->getCliente()->getCondfiscal() ?><br>
			</span>
		</td>
		<td>
			<span style="font-size: 14px;">
			<?php if ($resumen->getTipoFactura()->letra != 'X'): ?><b>Condición de Venta : </b><?php echo $resumen->getTipoVenta() ?><br><?php endif;?>
			<?php if (!empty($resumen->pedido_id)): ?><b>Pedido Nro: </b> <?php echo $resumen->getPedido()->id; ?><br><?php endif;?>
			<b>Estado : </b><?php echo empty($resumen->pagado)?'No Cobrada':'Cobrada'; ?><br>
			<?php if (!empty($resumen->pagado)): ?><b>Fecha Cobrada : </b><?php echo $resumen->getFechaCobrada() ?><br><?php endif;?>
			</span>
		</td>
	</tr>
	<?php if (!empty($resumen->observacion)): ?>
	<tr>
		<td colspan="3">
			<span style="font-size: 14px;"><b>Observacion: </b> <?php echo $resumen->getObservacion() ?></span>
		</td>
	</tr>
	<?php endif;?>
	<?php if (!empty($resumen->afip_mensaje)): ?>
	<tr>
		<td colspan="3">
			<span style="font-size: 14px;"><b>AFIP: </b> <?php echo $resumen->afip_mensaje ?></span>
		</td>
	</tr>
	<?php endif;?>
	<tr><td colspan="3">&nbsp;</td></tr>		
	</tbody>
</table>