<html>
<head>
</head>
<body>
<h1>Pago de Comisi&oacute;n</h1>
<h3><?php echo $pago->getRevendedor(); ?></h3>
<h3>Fecha: <?php echo implode('/', array_reverse(explode('-', $pago->fecha))) ?></h3>
<h3>Comisi&oacute;n: $ <?php echo $pago->monto ?></h3>
<h3>Detalle de ventas pagadas</h3>
  <?php $suma_total = 0; ?>
  <?php foreach($facturas as $fila): ?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr>
			<th style="background: #CCC;">Fecha</th>
			<th colspan="3" style="background: #CCC;">Factura</th>
			<th colspan="3" style="background: #CCC;">Cliente</th>
			<th style="background: #CCC;">Total</th>
		</tr>
		<tr>
			<td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
			<td colspan="3" ><?php echo $fila ?></td>
			<td colspan="3" ><?php echo $fila->getCliente() ?></td>
			<td>$ <?php echo $fila->getTotalResumen() ?></td>
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
					foreach($fila->getDetalle() as $det): ?>
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
						</tr>
		<?php endforeach; ?>
		<tr><td colspan="7" style="text-align:right;">Total Comisi&oacute;n&nbsp;</td><td><b style="font-size:16px;">&nbsp;$ <?php echo $total_comis_fact ?></b></td></tr>
	</table>
	<br>
  <?php endforeach;?>
	<table border="1" cellspacing="0" cellpadding="1" width="100%">
		<tr><td style="text-align:right;"><b style="font-size:20px; color: #F00;">Total Comisi&oacute;n&nbsp; $ <?php echo $pago->monto ?></b></td></tr>
	</table>
</body>
<html>