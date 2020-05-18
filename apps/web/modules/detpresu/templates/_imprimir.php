<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title></title>	
	<style type="text/css">
		body{font-family:Verdana; font-size:12px}
		.titulo{font-weight:bold; background-color:#CCCCCC}
		.alinear-izq{text-align:left}
		.alinear-der{text-align:right}
		.centrar{text-align:center}
		.tipo_fact{
			font-weight:bold; 
			font-size:30px; 
			border: 1px solid #000; 
			padding:10px;
			padding-left: 15px;
			background-color:#CCC;
		}
		#header {
				position: fixed;
				top: -10px;
		}
		#content {
				position: absolute;
				top: 220px;
		}
		#footer {
				position: fixed; 
				bottom: 360px;
		}
		#footer_remito {
				position: fixed; 
				bottom: 50px;
				font-weight: bold;
				text-align: center;
		}
		.pagenum:before {
			content: counter(page);
		}		
	</style>
	
</head>

<body>
<div id="header">
	<table cellpadding="10" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="44%">
				<img src="images/logo_nti.jpg" width=204 height=77>
				<p>
					<b>Razon Social: </b>NTI Implantes<br>
					<b>Domicilio Comercial: </b>Feliciano 581 - Paraná (Entre Ríos)<br>
					<b>Tel: </b>(0343) 4235207 / 155 094802<br>
					<b>Condición frente al IVA: </b>IVA Responsable Inscripto<br>
				</p>			
			</td>
			<td width="12%" valign="top">
				<div class="tipo_fact centrar">
					<span>P</span>
				</div>
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
		<table cellpadding="1" cellspacing="0" border="0" width="100%" style="border-top:1px solid #000; border-bottom:1px solid #000;">
		<tr>
			<td colspan="2" align="left"><b>Razón Social: </b><?php echo $presupuesto->descripcion ?></td>
		</tr>
	</table>
</div>
<div id="footer_remito">
	Pág. <span class="pagenum"></span> de <?php echo ceil(count($presupuesto->getDetallePresupuesto())/35) ?>
</div>
<div id="content">
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
</div>

</body>

</html>