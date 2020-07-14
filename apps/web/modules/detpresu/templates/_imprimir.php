<?php include_partial('global/cabecera_impresion') ?>
	<table cellpadding="10" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="56%">
				<p>
					<b>Razon Social: </b>NTI Implantes<br>
					<b>Domicilio Comercial: </b>Feliciano 581 - Paraná (Entre Ríos)<br>
					<b>Tel: </b>(0343) 4235207 / 155 094802<br>
					<b>Condición frente al IVA: </b>IVA Responsable Inscripto<br>
				</p>			
			</td>
			<td width="44%">
				<div style="margin-bottom: 40px; width:100%; font-weight:bold; font-size:14px; text-align:right;"></div>
				<span style="font-weight:bold; font-size: 22px;">PRESUPUESTO</span><br>
				<span style="font-size: 14px;">
					<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $presupuesto->fecha))) ?><br>
					<br>
					<b>C.U.I.T.: </b>30-71227246-1<br>
					<b>Ingresos Brutos: </b>30-71227246-1<br>
					<b>Inicio de Actividades: </b>01/05/2012
				</span>
				</b>
			</td>
		</tr>
		</table>
		<br>
		<table cellpadding="1" cellspacing="0" border="0" width="100%" style="border-top:1px solid #000; border-bottom:1px solid #000;">
		<tr>
			<td colspan="2" align="left"><b>Razón Social: </b><?php echo $presupuesto->descripcion ?></td>
		</tr>
		</table>
		<br>
<?php 
	$moneda = $presupuesto->getLista()->getMoneda()->getSimbolo();

	$total_items = count($presupuesto->getDetallePresupuesto());
	$cont = 0;
	$cont_total = 0;
	$primero = true;
	$items_por_pagina = 35;
  $total = 0;
  foreach($presupuesto->getDetallePresupuesto() as $detalle):
		if ($cont > $items_por_pagina) {
			$cont = 0;
			$primero = false;					
		}
		if ($cont == 0) :
			if (!$primero) echo '</table>';
		?>
		<table style="page-break-after: <?php echo ($cont_total + $items_por_pagina >= $total_items )?'never':'always'; ?>;" cellpadding="2" cellspacing="0" border="1" width="100%">	
			<tr>
				<th style="background: #CCC;">Producto</th>
				<th style="background: #CCC;">Precio Unitario</th>
				<th style="background: #CCC;">Cantidad</th>
				<th style="background: #CCC;">Descuento</th>
				<th style="background: #CCC;">Sub Total</th>
				<th style="background: #CCC;">IVA</th>
				<th style="background: #CCC;">Total</th>
			</tr>
		<?php endif; ?>
			<tr>
				<td><?php echo $detalle->getProducto() ?></td>
				<td><?php echo $moneda.' '.$detalle->precio ?></td>
				<td><?php echo $detalle->cantidad ?></td>
				<td><?php echo $detalle->descuento.'%' ?></td>
				<td><?php echo $moneda.' '.$detalle->sub_total ?></td>
				<td><?php echo $moneda.' '.$detalle->iva ?></td>
				<td><?php echo $moneda.' '.$detalle->total ?></td>
			</tr>
  <?php 
			$cont += 1;
			$cont_total += 1;
			$total += $detalle->total;
		endforeach;
  ?>
			<tr>
				<td colspan="5">&nbsp;</td>
				<td>Total: </td>
				<td><?php echo $moneda.' '.sprintf("%01.2f", $total) ?></td>
			</tr>  
	</table>
<?php include_partial('global/pie_impresion') ?>