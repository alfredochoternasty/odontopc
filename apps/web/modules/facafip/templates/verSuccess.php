<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div style="position:fixed; top:50px; height: 90%; overflow: scroll; width:99%; font-family: verdana; font-size: small;">
	<p style="font-weight: bold;text-align: center;color: #d90036;">Facturas</p>
	<?php foreach ($facturas as $fila): ?>
		<a href="<?php echo url_for('facafip/imprimir?rid='.$fila->id, true) ?>">
		<div style="width:97%; border: 1px solid #cccccc; margin:2%;">
			<table width="100%">
				<tr>
					<td>
						<span style="font-weight: bold; color: #2693ff;"><?php include_partial('comprobante', array('facturas_afip' => $fila)); ?></span><br>
						<span style="font-weight: bold;text-align: center;color: #b9b9c8;">Fecha: </span><span style="font-weight: bold; color: #2693ff;"><?php echo implode('/', array_reverse(explode('-', $fila->fecha))); ?></span><br>
					</td>
					<td width="30%" style="text-align:right; font-weight: bold;"><span ><?php echo sprintf("$"." %01.2f", $fila->total) ?></span></td>
				</tr>
			</table>
		</div>
		</a>
<?php endforeach; ?>
</div>