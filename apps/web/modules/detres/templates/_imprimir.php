<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 6.0.6.2 (Linux)"/>
	<meta name="author" content="www.todoexcel.com"/>
	<meta name="created" content="2010-04-15T00:15:23"/>
	<meta name="changedby" content="casa"/>
	<meta name="changed" content="2018-09-17T19:00:20"/>
	
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
	</style>
	
</head>

<body>

<table cellpadding="10" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="45%">
			<img src="images/logo_nti.png" width=204 height=77>
			<p>
				<b>Razon Social: </b>NTI Implantes<br>
				<b>Domicilio: </b>Feliciano 581 - Paraná (Entre Ríos)<br>
				<b>Tel: </b>(0343) 4235207 / 155 094802<br>
				<b>C.U.I.T.: </b>30-71227246-1<br>
				<b>Ingresos Brutos: </b>30-71227246-1<br>
				<b>Inicio de Actividades: </b>01/05/2012
			</p>			
		</td>
		<td width="10%" valign="top">
			<div class="tipo_fact">
				<?php 
					echo $resumen->getTipoFactura()->getLetra();
				?>
			</div>
		</td>
		<td width="45%">
			<div style="margin-bottom: 40px; width:100%; font-weight:bold; font-size:14px; text-align:right;">SIN VALIDEZ</div>
			<span style="font-weight:bold; font-size: 22px;">
				<?php 
					if ($resumen->getTipoFactura()->letra == 'X') 
						echo 'REMITO'; 
					else 
						echo substr($resumen->getTipoFactura(), 0, -2);
				?>
			</span><br>
			<span style="font-size: 14px;">
				<b>Punto de Venta: </b>0004<b style="margin-left: 20px;">Comp. Nro: </b><?php echo str_pad($resumen->getNroFactura(), 8, 0,STR_PAD_LEFT) ?><br>
				<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getFecha()))) ?><br>
				<b>CAE: </b><?php echo $resumen->getAfipMensaje() ?><br>
				<b>Fecha Vto CAE: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getAfipVtoCae()))) ?>
			</span>
			</b>
		</td>
	</tr>
</table>
<table cellpadding="2" cellspacing="0" border="1" width="100%">	
	<tr>
		<td align="left"><b>Razón Social: </b><?php echo $resumen->getCliente() ?></td>
		<td align="left"><b>Domicilio: </b><?php echo $resumen->getCliente()->getDomicilio() ?> - <?php echo $resumen->getCliente()->getLocalidad() ?></td>
	</tr>
	<tr>
		<td align="left"><b>C.U.I.T. : </b><?php echo $resumen->getCliente()->getCuit() ?></td>
		<td align="left"><b>Condición frente al I.V.A. : </b><?php echo $resumen->getCliente()->getCondfiscal() ?></td>
	</tr>
	<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
		<tr><td colspan=2 align="left"><b>Condición de Venta : </b>Cuenta Corriente</td></tr>	
	<?php endif;?>
</table>
<br>
<table cellpadding="2" cellspacing="0" border="1" width="100%">	
	<tr class="titulo">
		<td><b>Artículo</b></td>
		<td><b>Cantidad</b></td>
		<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
			<td><b>Precio Un.</b></td>
			<td><b>Subtotal</b></td>
			<?php if ($resumen->getTipoFactura()->letra == 'A'): ?>
				<td><b>IVA</b></td>
				<td><b>Total con IVA</b></td>
			<?php endif;?>
		<?php endif;?>
	</tr>
	<?php 
		$total_con_iva = 0;
		$total_sin_iva = 0;
		foreach($resumen->getDetalle() as $detalle):?>
	<tr>
		<td><?php echo $detalle->getProducto() .' - '. $detalle->getNroLote()?></td>
		<td><?php echo $detalle->getCantidad() ?></td>
		<?php 
			if ($resumen->getTipoFactura()->letra != 'X'): 
					if ($resumen->getTipoFactura()->letra == 'A'): 
		?>
		<td><?php echo $detalle->PrecioFormato() ?></td>
		<td><?php echo $detalle->SubTotalFormato() ?></td>
		<td><?php echo $detalle->IvaFormato() ?></td>
		<td><?php echo $detalle->TotalFormato() ?></td>
		<?php else: ?>
		<td><?php echo sprintf($detalle->SimboloMoneda()." %01.2f", $detalle->total/$detalle->cantidad) ?></td>
		<td><?php echo $detalle->TotalFormato() ?></td>
		<?php endif; 
				$total_con_iva += $detalle->total;
				$total_sin_iva += $detalle->sub_total;
			endif;
		?>
	</tr>
	<?php 
		endforeach;
		if ($resumen->getTipoFactura()->letra != 'X'): 
	?>	
	<tr><td colspan="<?php echo ($resumen->getTipoFactura()->letra == 'A')?6:4; ?>"><br></td></tr>
	<tr>
		<td colspan="<?php echo ($resumen->getTipoFactura()->letra == 'A')?5:3; ?>" align="right"><b>Total:&nbsp;&nbsp;</b></td>
		<td><b><?php echo ($resumen->getTipoFactura()->letra == 'A')?sprintf($detalle->SimboloMoneda()." %01.2f", $total_con_iva):sprintf($detalle->SimboloMoneda()." %01.2f", $total_sin_iva) ?></b></td>
	</tr>
	<?php endif; ?>
</table>

</body>

</html>
