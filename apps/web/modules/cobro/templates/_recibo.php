<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
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
		</td>
		<td width="45%">
			<div style="margin-bottom: 40px; width:100%; font-weight:bold; font-size:14px; text-align:right;"></div>
			<span style="font-weight:bold; font-size: 22px;">Comprobante de Pago</span><br>
			<span style="font-size: 14px;">
				<b>Comp. Nro: </b><?php echo str_pad($cobro->getNroRecibo(), 8, 0,STR_PAD_LEFT) ?><br>
				<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $cobro->getFecha()))) ?><br>
			</span>
			</b>
		</td>
	</tr>
</table>
<table cellpadding="2" cellspacing="0" border="1" width="100%">	
	<tr>
		<td align="left"><b>Razón Social: </b><?php echo $cobro->getCliente() ?></td>
		<td align="left"><b>Domicilio: </b><?php echo $cobro->getCliente()->getDomicilio() ?> - <?php echo $cobro->getCliente()->getLocalidad() ?></td>
	</tr>
	<tr>
		<td align="left"><b>C.U.I.T. : </b><?php echo $cobro->getCliente()->getCuit() ?></td>
		<td align="left"><b>Condición frente al I.V.A. : </b><?php echo $cobro->getCliente()->getCondfiscal() ?></td>
	</tr>
</table>
<br>
<table cellpadding="2" cellspacing="0" border="1" width="100%">	
	<tr class="titulo">
		<td><b>Forma de Pago</b></td>
		<td><b>Total</b></td>
	</tr>
	<tr>
		<td><?php echo $cobro->getTipo() ?></td>
		<td><?php echo $cobro->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $cobro->getMonto()) ?></td>
	</tr>
	<?php if (!empty($cobro->banco_id)) { ?>
	<tr><td colspan="2"><?php echo $cobro->getBanco().'<br>Nro. '.$cobro->getTipo().': '.$cobro->getNumero() ?></td></tr>
	<?php } ?>
</table>

</body>

</html>
