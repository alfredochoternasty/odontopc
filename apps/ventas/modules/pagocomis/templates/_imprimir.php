<?php //include_partial('global/cabecera_impresion') ?>
<h1>Pago de Comisi&oacute;n</h1>
<h3><?php echo utf8_decode($pago->getRevendedor()); ?></h3>
<h3>Fecha: <?php echo implode('/', array_reverse(explode('-', $pago->fecha))) ?></h3>
<h3>Comisi&oacute;n: $ <?php echo $pago->monto ?></h3>
<h3>Detalle de ventas pagadas</h3>
  <?php $suma_total = 0; ?>
  <?php 
	foreach($facturas as $fila): 	
	?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<td style="background: #CCC;">Fecha</td>
			<td colspan="3" style="background: #CCC;">Factura</td>
			<td colspan="2" style="background: #CCC;">Cliente</td>
			<td style="background: #CCC;">Total</td>
			<td style="background: #CCC;">Cobrado</td>
		</tr>
		<tr>
			<td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
			<td colspan="3"><?php echo $fila ?></td>
			<td colspan="2"><?php echo $fila->getCliente() ?></td>
			<td>$ <?php echo $fila->getTotalResumen() ?></td>
			<td><?php echo implode("/", array_reverse(explode("-", $fila->fecha_pagado))) ?></td>
		</tr>
		<tr>
			<td style="background: #CCC;">Producto</td>
			<td style="background: #CCC;">Precio</td>
			<td style="background: #CCC;">Cant.</td>
			<td style="background: #CCC;">Neto</td>
			<td style="background: #CCC;">IVA</td>
			<td style="background: #CCC;">Total</td>
			<td style="background: #CCC;">Porc.</td>
			<td style="background: #CCC;">Comisi&oacute;n</td>
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
				<td style="text-align: center;"><?php echo $det->getVentasZona()->grupo_porc_desc ?>%</td>
				<?php $comision = $det->sub_total * ($det->getVentasZona()->grupo_porc_desc/100); ?>
				<td>$ <?php echo $comision ?></td>
				<?php $total_comis_fact += $comision; ?>
				<?php $suma_total += $comision; ?>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="7" style="text-align:right;">Total Comisi&oacute;n&nbsp;</td>
			<td><b style="font-size:16px;">&nbsp;$ <?php echo $total_comis_fact ?></b></td>
		</tr>
	</table>
	<br>
  <?php endforeach;?>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" widtd="100%">
		<tr>
			<td style="text-align:right;"><b style="font-size:20px; color: #F00;">Total Comisiones $ <?php echo $suma_total ?></b></td>
		</tr>
	</table>
	<br>
	<?php 
		$devueltos = Doctrine_core::getTable('DevProducto')->findByPagoComisionId($pago->id);
		if (!empty($devueltos[0])):
	?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<td colspan="11" style="background: #CCC;">Devoluciones</td>
		</tr>
		<tr>
			<td style="background: #CCC;">Fecha</td>
			<td style="background: #CCC;">Factura</td>
			<td style="background: #CCC;">Cliente</td>
			<td style="background: #CCC;">Producto</td>
			<td style="background: #CCC;">Precio</td>
			<td style="background: #CCC;">Cant.</td>
			<td style="background: #CCC;">Neto</td>
			<td style="background: #CCC;">IVA</td>
			<td style="background: #CCC;">Total</td>
			<td style="background: #CCC;">Porc.</td>
			<td style="background: #CCC;">Comisi&oacute;n</td>
		</tr>
		<?php 
			$tot_descuento = 0;
				foreach ($devueltos as $devuelto): ?>
					<tr>
						<td><?php echo $devuelto->fecha ?></td>
						<td><?php echo $devuelto ?></td>
						<td><?php echo $devuelto->getCliente() ?></td>
						<td><?php echo $devuelto->getProducto() ?></td>
						<td><?php echo $devuelto->precio ?></td>
						<td><?php echo $devuelto->cantidad ?></td>
						<td><?php echo $devuelto->precio * $devuelto->cantidad ?></td>
						<td><?php echo $devuelto->iva ?></td>
						<td><?php echo $devuelto->total ?></td>
					<td>
						<?php
							$grupoprod_id = Doctrine_Core::getTable('Producto')->find($devuelto->producto_id)->grupoprod_id;
							$desc_zona_grupo = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndGrupoprodId($devuelto->zona_id, $grupoprod_id);
							$desc_zona_prod = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndProductoId($devuelto->zona_id, $devuelto->producto_id);
							
							$descuento = 0;
							if (!empty($desc_zona_grupo[0]->porc_desc)) {
								$descuento = sprintf("%01.2f", $desc_zona_grupo[0]->porc_desc)." %";
							} elseif (!empty($desc_zona_prod[0]->porc_desc)) {
								$descuento = sprintf("%01.2f", $desc_zona_prod[0]->porc_desc)." %";
							}
							echo $descuento;
					?>
					</td>					
					<td>
						<?php
							if (!empty($desc_zona_grupo[0]->porc_desc)) {
								$descuento = ($devuelto->precio * $devuelto->cantidad) * ($desc_zona_grupo[0]->porc_desc/100);
							} elseif (!empty($desc_zona_prod[0]->porc_desc)) {
								$descuento = ($devuelto->precio * $devuelto->cantidad) * ($desc_zona_prod[0]->porc_desc/100);
							} else {
								$descuento = 0;
							}
							echo sprintf("$ %01.2f", $descuento); 
							$tot_descuento += $descuento;
						?>					
					</td>
				</tr>
      <?php endforeach;	?>
	</table>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<td style="text-align:right;"><b style="font-size:20px; color: #F00;">Total Devoluciones $ <?php echo $tot_descuento ?></b></td>
		</tr>
	</table>
	<?php endif; ?>
	<br>
	<br>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<td style="text-align:right;"><b style="font-size:30px; color: #F00;">Total Comisi&oacute;n&nbsp; $ <?php echo $pago->monto ?></b></td>
		</tr>
	</table>
<?php include_partial('global/pie_impresion') ?>