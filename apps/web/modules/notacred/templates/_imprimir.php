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
				bottom: 60px;
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
				<img src="images/logo_nti.png" width=204 height=77>
				<p>
					<b>Razon Social: </b>NTI Implantes<br>
					<b>Domicilio Comercial: </b>Feliciano 581 - Paraná (Entre Ríos)<br>
					<b>Tel: </b>(0343) 4235207 / 155 094802<br>
					<b>Condición frente al IVA: </b>IVA Responsable Inscripto<br>
				</p>			
			</td>
			<td width="12%" valign="top">
				<div class="tipo_fact centrar">
					<span><?php echo $dev_producto->getTipoFactura()->getLetra(); ?></span>
					<?php if ($dev_producto->getTipoFactura()->letra != 'X'): ?>
					<span style="font-size:11px; font-weight:bold;"><?php echo 'cod '.str_pad($dev_producto->getTipoFactura()->cod_tipo_afip, 2, "0", STR_PAD_LEFT); ?></span>
					<?php endif; ?>
				</div>
			</td>
			<td width="44%">
				<div style="margin-bottom: 40px; width:100%; font-weight:bold; font-size:14px; text-align:right;"></div>
				<span style="font-weight:bold; font-size: 22px;">
					<?php 
						if ($dev_producto->getTipoFactura()->letra == 'X') 
							echo 'REMITO'; 
						else 
							echo substr($dev_producto->getTipoFactura(), 0, -2);
					?>
				</span><br>
				<span style="font-size: 14px;">
					<b>Punto de Venta: </b><?php echo str_pad($dev_producto->getPtoVta(), 4, 0,STR_PAD_LEFT) ?><b style="margin-left: 20px;">Comp. Nro: </b><?php echo str_pad($dev_producto->getNroFactura(), 8, 0,STR_PAD_LEFT) ?><br>
					<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $dev_producto->getFecha()))) ?><br>
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
			<td align="left"><b>C.U.I.T. : </b><?php echo $dev_producto->getCliente()->getCuit() ?></td>
			<td colspan="2" align="left"><b>Razón Social: </b><?php echo $dev_producto->getCliente() ?></td>
		</tr>
		<tr>
			<td align="left"><b>Condición frente al IVA. : </b><?php echo $dev_producto->getCliente()->getCondfiscal() ?></td>
			<td colspan="2" align="left"><b>Domicilio Comercial: </b><?php echo $dev_producto->getCliente()->getDomicilio() ?> - <?php echo $dev_producto->getCliente()->getLocalidad() ?></td>
		</tr>
		<?php if ($dev_producto->getTipoFactura()->letra != 'X'): ?>
			<tr>
				<td align="left"><b>Condición de Venta : </b>Cuenta Corriente</td>
				<td colspan="2" align="left"><b>Factura: </b><?php echo $dev_producto->getResumen() ?></td>
			</tr>	
		<?php endif;?>
	</table>
</div>

<?php if ($dev_producto->getTipoFactura()->letra != 'X'): ?>
<div id="footer">
	<table>
		<tr>
			<td style="width:60%; vertical-align: top;">Otros Tributos<br>
				<table cellpadding="1" cellspacing="0" border="0" width="100%">	
					<tr class="titulo" style="border: 1px solid #000;"><td>Descripción</td><td>Detalle</td><td>Alic. %</td><td>Importe</td></tr>
					<tr><td>Per./Ret. de Impuesto a las Ganancias</td><td>&nbsp;</td><td>&nbsp;</td><td>0.00</td></tr>
					<tr><td>Per./Ret. de IVA</td><td>&nbsp;</td><td>&nbsp;</td><td>0.00</td></tr>
					<tr><td>Per./Ret. Ingresos Brutos</td><td>&nbsp;</td><td>&nbsp;</td><td>0.00</td></tr>
					<tr><td>Impuestos Internos</td><td>&nbsp;</td><td>&nbsp;</td><td>0.00</td></tr>
					<tr><td>Impuestos Municipales</td><td>&nbsp;</td><td>&nbsp;</td><td>0.00</td></tr>
					<tr><td>&nbsp;</td><td colspan="2">Importe Otros Tributos: $</td><td>0.00</td></tr>
				</table>
			</td>
			<td style="width:40%;"><b>
				<table>
					<tr><td>Importe Neto Gravado: $</td><td><?php echo ($dev_producto->getTipoFactura()->letra == 'A')?$dev_producto->getSubTotal():'0.00'; ?></td></tr>
					<tr><td>IVA 27%: $</td><td>0.00</td></tr>
					<tr><td>IVA 21%: $</td><td><?php echo ($dev_producto->getTipoFactura()->letra == 'A')?$dev_producto->getIVATotal():'0.00'; ?></td></tr>
					<tr><td>IVA 10.5%: $</td><td>0.00</td></tr>
					<tr><td>IVA 5%: $</td><td>0.00</td></tr>
					<tr><td>IVA 2.5%: $</td><td>0.00</td></tr>
					<tr><td>IVA 0%: $</td><td>0.00</td></tr>
					<tr><td>Importe Otros Tributos: $</td><td>0.00</td></tr>
					<tr><td>Importe Total: $</td><td><?php echo $dev_producto->getTotal() ?></td></tr>
				</table>
				</b>
			</td>
		</tr>
		<tr><td colspan="3" style="text-align:center;"><b>Pág. 1 de 1</b></td></tr>
		<tr>
			<td style="width:60%; text-align:center;">
				<img src="http://ventas.ntiimplantes.com.ar/web/afip.png">
				<br>
				<?php
					$nro = '30712272461'.str_pad($dev_producto->getTipoFactura()->cod_tipo_afip, 2, "0", STR_PAD_LEFT).str_pad($dev_producto->pto_vta, 4, "0", STR_PAD_LEFT).$dev_producto->getAfipCae().implode('', explode('-', $dev_producto->getAfipVtoCae()));
					$suma_par = $suma_impar = 0;
					for ($i=0; $i<39; $i++) {
						if (($i % 2) == 0) {
							$suma_impar += $nro[$i];
							//echo $nro[$i].'-';
						} else {
							$suma_par += $nro[$i];
						}
					}
					$suma_impar = $suma_impar * 3;
					$total = $suma_par + $suma_impar;
					$d_v = 10 - ($total % 10);
					if ($d_v == 10) $d_v = 0;
				?>
				&nbsp;&nbsp;&nbsp;<img src="http://ventas.ntiimplantes.com.ar/web/codigo.php?nro=<?php echo $nro.$d_v; ?>">
				<?php echo $nro.$d_v; ?>
			</td>
			<td style="width:40%; font-size:14px;">
				<b>CAE N&ordm;: </b><?php echo $dev_producto->getAfipCae() ?><br>
				<b>Fecha Vto. de CAE: </b><?php echo implode('/', array_reverse(explode('-', $dev_producto->getAfipVtoCae()))) ?>
			</td>
		</tr>	
	</table>
</div>
<?php else: ?>
<div id="footer_remito">
	Pág. <span class="pagenum"></span> de <?php echo floor(count($dev_producto->getDetalle())/15) ?>
</div>
<?php endif; ?>

<div id="content">
<br>
<table cellpadding="2" cellspacing="0" border="1" width="100%">	
	<tr class="titulo">
		<td><b>Artículo</b></td>
		<td><b>Precio Un.</b></td>
		<td><b>Subtotal</b></td>
		<?php if ($dev_producto->getTipoFactura()->letra == 'A'): ?>
		<td><b>% IVA</b></td>
		<td><b>Total con IVA</b></td>
		<?php endif;?>
	</tr>
	<tr>
		<td>Ajuste de saldo</td>
		<td><?php echo ($dev_producto->getTipoFactura()->letra == 'A')? $dev_producto->getPrecio(): $dev_producto->total/$dev_producto->cantidad; ?></td>
		<td><?php echo ($dev_producto->getTipoFactura()->letra == 'A')? $dev_producto->getSubTotal(): $dev_producto->getTotal(); ?></td>
		<?php if ($dev_producto->getTipoFactura()->letra == 'A'): ?>
		<td><?php echo $dev_producto->getIva() ?></td>
		<td><?php echo $dev_producto->getTotal() ?></td>
		<?php endif;?>
	</tr>
</table>
</div>
</body>

</html>
