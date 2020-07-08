<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div style="position:fixed; top:50px; height: 90%; overflow: scroll; width:99%; font-family: verdana; font-size: small;">
	<p style="font-weight: bold;text-align: center;color: #d90036;">Cuenta Corriente</p>
	<p style="font-size: 12pt; font-weight: bold;text-align: center;color: #000000;">Saldo $<?php echo $saldo ?></p>
	<?php foreach ($ctacte as $fila): ?>
		<div style="width:97%; border: 1px solid #cccccc; margin:2%;">
			<table width="100%">
				<?php
					if ($fila->concepto == 'Venta') {
						$comprobante = Doctrine::getTable('Resumen')->find($fila->numero);
					} elseif ($fila->concepto == 'Cobro') {
						$comprobante = Doctrine::getTable('Cobro')->find($fila->numero);
					} else {
						$comprobante = Doctrine::getTable('DevProducto')->find($fila->numero);
					} 
					// else {
						// $comprobante = $fila->concepto;
					// }
				?>
				<tr>
					<td>
						<span style="font-weight: bold; color: #2693ff;"><?php echo $comprobante; ?></span><br>
						<span style="font-weight: bold;text-align: center;color: #b9b9c8;">Fecha: </span><span style="font-weight: bold; color: #2693ff;"><?php echo implode('/', array_reverse(explode('-', $fila->fecha))); ?></span><br>
            <span style="font-weight: bold;text-align: center;color: #b9b9c8;">Concepto: </span><span  style="font-weight: bold; color: #2693ff;"><?php echo $fila->concepto; ?></span>
					</td>
					<td width="30%" style="text-align:right; font-weight: bold; color:<?php echo !empty($fila->debe)?'#ff0040':'#008c46' ?>;"><span ><?php echo !empty($fila->debe)?' - $ '.$fila->debe:' + $ '.$fila->haber ?></span></td>
				</tr>
			</table>
		</div>
<?php endforeach; ?>
</div>