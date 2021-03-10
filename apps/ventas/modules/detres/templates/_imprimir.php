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
				bottom: 300px;
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
				<img src="images/logo_nti_chico.png" width=204 height=77>
				<p>
					<b>Razon Social: </b>NTI Implantes<br>
					<b>Domicilio Comercial: </b>Feliciano 581 - Paraná (Entre Ríos)<br>
					<b>Tel: </b>(0343) 4235207 / 155 094802<br>
					<b>Condición frente al IVA: </b>IVA Responsable Inscripto<br>
				</p>			
			</td>
			<td width="12%" valign="top">
				<div class="tipo_fact centrar">
					<span><?php echo $resumen->getTipoFactura()->getLetra(); ?></span>
					<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
					<span style="font-size:11px; font-weight:bold;"><?php echo 'cod '.str_pad($resumen->getTipoFactura()->cod_tipo_afip, 2, "0", STR_PAD_LEFT); ?></span>
					<?php endif; ?>
				</div>
			</td>
			<td width="44%">
				<div style="margin-bottom: 40px; width:100%; font-weight:bold; font-size:14px; text-align:right;"></div>
				<span style="font-weight:bold; font-size: 22px;">
					<?php 
						if ($resumen->getTipoFactura()->letra == 'X') 
							echo 'REMITO'; 
						else 
							echo substr($resumen->getTipoFactura(), 0, -2);
					?>
				</span><br>
				<span style="font-size: 14px;">
					<b>Punto de Venta: </b><?php echo str_pad($resumen->getPtoVta(), 4, 0,STR_PAD_LEFT) ?><b style="margin-left: 20px;">Comp. Nro: </b><?php echo str_pad($resumen->getNroFactura(), 8, 0,STR_PAD_LEFT) ?><br>
					<b>Fecha de Emisión: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getFecha()))) ?><br>
					<br>
					<b>C.U.I.T.: </b>30-71227246-1<br>
					<b>Ingresos Brutos: </b>30-71227246-1<br>
					<b>Inicio de Actividades: </b>01/05/2012
				</span>
			</td>
		</tr>
	</table>
	<table cellpadding="1" cellspacing="0" border="0" width="100%" style="border-top:1px solid #000; border-bottom:1px solid #000;">
		<tr>
			<td align="left"><b>C.U.I.T. : </b><?php echo $resumen->getCliente()->getCuit() ?></td>
			<td colspan="2" align="left"><b>Razón Social: </b><?php echo $resumen->getCliente() ?></td>
		</tr>
		<tr>
			<td align="left"><b>Condición frente al IVA. : </b><?php echo $resumen->getCliente()->getCondfiscal() ?></td>
			<td colspan="2" align="left"><b>Domicilio Comercial: </b><?php echo $resumen->getCliente()->getDomicilio() ?> - <?php echo $resumen->getCliente()->getLocalidad() ?></td>
		</tr>
		<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
			<tr><td colspan=3 align="left"><b>Condición de Venta : </b>Cuenta Corriente</td></tr>	
		<?php endif;?>
	</table>
</div>

<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
<div id="footer">
	<table width="100%">
		<tr>
			<td style="width:70%; vertical-align: top;">Otros Tributos<br>
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
			<td	style="width:30%;"><b>
				<table>
					<tr><td>Importe Neto Gravado: $</td><td style="text-align:right;"><?php echo ($resumen->getTipoFactura()->letra == 'A')?$resumen->getSubTotalResumen():'0.00'; ?></td></tr>
					<tr><td>IVA 27%: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>IVA 21%: $</td><td style="text-align:right;"><?php echo ($resumen->getTipoFactura()->letra == 'A')?$resumen->getIVATotalResumen():'0.00'; ?></td></tr>
					<tr><td>IVA 10.5%: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>IVA 5%: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>IVA 2.5%: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>IVA 0%: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>Importe Otros Tributos: $</td><td style="text-align:right;">0.00</td></tr>
					<tr><td>Importe Total: $</td><td style="text-align:right;"><?php echo sprintf("%01.2f", $resumen->getTotalResumen()) ?></td></tr>
				</table>
				</b>
			</td>
		</tr>
		<tr><td colspan="2" style="text-align:center;"><b>Pág. <span class="pagenum"></span> de <?php echo ceil(count($resumen->getDetalle())/10) ?></b></td></tr>
		<tr>
			<td style="text-align:left; vertical-align:top">
				<?php			
					
					$codeContents = 'https://www.afip.gob.ar/fe/qr/?p='.base64_encode(json_encode(array(
						'ver' => 1,
						'fecha' => implode('/', array_reverse(explode('-', $resumen->getFecha()))),
						'cuit' => '30712272461',
						'ptoVta' => str_pad($resumen->pto_vta, 4, "0", STR_PAD_LEFT),
						'tipoCmp' => str_pad($resumen->getTipoFactura()->cod_tipo_afip, 2, "0", STR_PAD_LEFT),
						'nroCmp' => str_pad($resumen->getNroFactura(), 8, 0,STR_PAD_LEFT),
						'importe' => $resumen->getIVATotalResumen(),
						'moneda' => 'PES',
						'ctz' => 1,
						'tipoDocRec' => 80,
						'nroDocRec' => $resumen->getCliente()->getCuit(),
						'tipoCodAut' => 'E',
						'codAut' => $resumen->getAfipCae()
					)));
					
					$tempDir = 'images/';
					$fileName = 'qr_afip.png';    
					$pngAbsoluteFilePath = $tempDir.$fileName;
					@unlink($pngAbsoluteFilePath);
        	QRcode::png($codeContents, $pngAbsoluteFilePath);			
					
				?>
				<img width="100px" height="100px" src="<?php echo $pngAbsoluteFilePath; ?>">
				<img src="images/afip.png">
			</td>
			<td>
				<b>CAE N&ordm;: </b><?php echo $resumen->getAfipCae() ?><br>
				<b>Fecha Vto. de CAE: </b><?php echo implode('/', array_reverse(explode('-', $resumen->getAfipVtoCae()))) ?>
			</td>
		</tr>	
	</table>
</div>
<?php else: ?>
<div id="footer_remito">
	Pág. <span class="pagenum"></span> de <?php echo ceil(count($resumen->getDetalle())/20) ?>
</div>
<?php endif; ?>

<div id="content">
<br>
	<?php 
		$total_con_iva = 0;
		$total_sin_iva = 0;
		$total_iva = 0;
		$total_items = count($resumen->getDetalle());
		$cont = 0;
		$cont_total = 0;
		$primero = true;
		$items_por_pagina = ($resumen->getTipoFactura()->letra != 'X')?10:20;
		foreach($resumen->getDetalle() as $detalle):
			if ($cont > $items_por_pagina) {
				$cont = 0;
				$primero = false;					
			}
			if ($cont == 0) :
				if (!$primero) {
					echo '</table>';
				}
		?>
			<table style="page-break-after: <?php echo ($cont_total + $items_por_pagina >= $total_items )?'never':'always'; ?>;" cellpadding="2" cellspacing="0" border="1" width="100%">	
				<tr class="titulo">
					<td><b>Nro.</b></td>
					<td><b>Artículo</b></td>
					<td><b>Cantidad</b></td>
					<?php if ($resumen->getTipoFactura()->letra != 'X'): ?>
						<td><b>Precio Un.</b></td>
						<td><b>% Bonif.</b></td>
						<td><b>Subtotal</b></td>
						<?php if ($resumen->getTipoFactura()->letra == 'A'): ?>
							<td><b>IVA</b></td>
							<td><b>Total con IVA</b></td>
						<?php endif; ?>
					<?php endif; ?>
				</tr>
		<?php endif; ?>
			<tr>
				<td><?php echo $cont_total+1 ?></td>
				<td><?php echo $detalle->getProducto() .'<br>'. $detalle->getNroLote()?></td>
				<td><?php echo $detalle->getCantidad() ?></td>
				<?php 
					if ($resumen->getTipoFactura()->letra != 'X'): 
							if ($resumen->getTipoFactura()->letra == 'A'): 
				?>
							<td><?php echo $detalle->PrecioFormato() ?></td>
							<td><?php echo $detalle->getDescuento() ?></td>
							<td><?php echo $detalle->SubTotalFormato() ?></td>
							<td><?php echo $detalle->IvaFormato() ?></td>
							<td><?php echo $detalle->TotalFormato() ?></td>
				<?php else: ?>
								<td><?php echo sprintf($detalle->SimboloMoneda()." %01.2f", $detalle->total/$detalle->cantidad)?></td>
								<td><?php echo $detalle->getDescuento() ?></td>
								<td><?php echo $detalle->TotalFormato() ?></td>
				<?php endif; 
						$total_con_iva += $detalle->total;
						$total_sin_iva += $detalle->sub_total;
						$total_iva += $detalle->iva;
					endif;
				?>
			</tr>
			<?php
			$cont += 1;
			$cont_total += 1;
		endforeach; 
	?>	
	</table>
</div>
</body>
</html>
