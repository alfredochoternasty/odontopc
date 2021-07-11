<?php //include_partial('global/cabecera_impresion') ?>
<h1>Pago de Comisi&oacute;n</h1>
<h3><?php echo utf8_decode($pago->getRevendedor()); ?></h3>
<h3>Fecha: <?php echo implode('/', array_reverse(explode('-', $pago->fecha))) ?></h3>
<h3>Comisi&oacute;n: $ <?php echo number_format($pago->monto, 2, ',', '.') ?></h3>
<h3>Detalle de comisiones pagadas</h3>
<?php $suma_total = 0; ?>
<?php 

	foreach($facturas as $fila): 	
	?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<th style="background: #CCC;">Fecha</th>
			<th colspan="3" style="background: #CCC;">Factura</th>
			<th colspan="2" style="background: #CCC;">Cliente</th>
			<th style="background: #CCC;">Total</th>
			<th style="background: #CCC;">Cobrado</th>
		</tr>
		<tr>
			<td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
			<td colspan="3" ><?php echo $fila ?></td>
			<td colspan="2" ><?php echo $fila->getCliente() ?></td>
			<td>$ <?php echo number_format($fila->getTotalResumen(), 2, ',', '.') ?></td>
			<td><?php echo implode("/", array_reverse(explode("-", $fila->fecha_pagado))) ?></td>
		</tr>
		<tr>
			<th style="background: #CCC;">Producto</th>
			<th style="background: #CCC;">Precio</th>
			<th style="background: #CCC;">Cant.</th>
			<th style="background: #CCC;">Neto</th>
			<th style="background: #CCC;">IVA</th>
			<th style="background: #CCC;">Total</th>
			<th style="background: #CCC;">Porc.</th>
			<th style="background: #CCC;">Comisi&oacute;n</th>
		</tr>
		<?php 
			$total_comis_fact = 0;
			foreach($fila->getDetalle() as $det): 
		?>
			<tr>
				<td><?php echo utf8_decode($det->getProducto()) ?></td>
				<td>$ <?php echo $det->precio ?></td>
				<td style="text-align: center;"><?php echo $det->cantidad ?></td>
				<td>$ <?php echo $det->sub_total ?></td>
				<td>$ <?php echo $det->iva ?></td>
				<td>$ <?php echo $det->total ?></td>
				<td style="text-align: center;"><?php echo $det->getPorcentajeComision() ?>%</td>
				<td>$ <?php echo number_format($det->getComision(), 2, ',', '.') ?></td>
				<?php $total_comis_fact += $det->getComision(); ?>
				<?php $suma_total += $det->getComision(); ?>
			</tr>
		<?php endforeach; ?>
		<tr><td colspan="7" style="text-align:right;">Total Comisi&oacute;n&nbsp;</td><td><b style="font-size:16px;">&nbsp; <?php echo '$ '.number_format($total_comis_fact, 2, ',', '.') ?></b></td></tr>
	</table>
	<br>
  <?php endforeach;?>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr><td style="text-align:right;"><b style="font-size:20px; color: #F00;">Total Comisiones $ <?php echo number_format($suma_total, 2, ',', '.') ?></b></td></tr>
	</table>
	<br>
	<?php 
		$devs = Doctrine_core::getTable('DevProducto')->findByPagoComisionId($pago->id);
		if (!empty($devs[0])):
	?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<th colspan="11" style="background: #CCC;">Devoluciones</th>
		</tr>
		<tr>
			<th style="background: #CCC;">Fecha</th>
			<th style="background: #CCC;">Factura</th>
			<th style="background: #CCC;">Cliente</th>
			<th style="background: #CCC;">Producto</th>
			<th style="background: #CCC;">Precio</th>
			<th style="background: #CCC;">Cant.</th>
			<th style="background: #CCC;">Neto</th>
			<th style="background: #CCC;">IVA</th>
			<th style="background: #CCC;">Total</th>
			<th style="background: #CCC;">Porc.</th>
			<th style="background: #CCC;">Comisi&oacute;n</th>
		</tr>
		<?php 
			$tot_descuento = 0;
				foreach ($devs as $dev): ?>
					<tr>
						<td><?php echo $dev->fecha ?></td>
						<td><?php echo $dev ?></td>
						<td><?php echo $dev->getCliente() ?></td>
						<td><?php echo $dev->getProducto() ?></td>
						<td><?php echo $dev->precio ?></td>
						<td><?php echo $dev->cantidad ?></td>
						<td><?php echo $dev->precio * $dev->cantidad ?></td>
						<td><?php echo $dev->iva ?></td>
						<td><?php echo $dev->total ?></td>
						<td><?php	echo $dev->getPorcentajeComision() ?></td>					
						<td>
							<?php
								echo '$ '.number_format($dev->getComision(), 2, ',', '.');
								$tot_descuento += $dev->getComision();
							?>
						</td>
					</tr>
      <?php endforeach;	?>
	</table>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr><td style="text-align:right;"><b style="font-size:20px; color: #F00;">Total Devoluciones <?php echo number_format($tot_descuento, 2, ',', '.') ?></b></td></tr>
	</table>
	<?php endif; ?>
	<br>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr><td style="text-align:right;"><b style="font-size:30px; color: #F00;">Total Comisi&oacute;n&nbsp; $ <?php echo number_format($pago->monto, 2, ',', '.') ?></b></td></tr>
	</table>
<?php include_partial('global/pie_impresion') ?>