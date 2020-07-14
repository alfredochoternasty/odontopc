<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="contenido">
	<h3 class="titulo">Detalle de Cuenta</h3>
	<?php 
		if (count($ctacte) > 0):
	?>
		<p style="text-align:center;" class="monto <?php echo ($saldo<0)?'monto_negativo':'monto_positivo' ?>">Saldo $<?php echo $saldo ?></p>
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
						<span class="fila_primario"><?php echo implode('/', array_reverse(explode('-', $fila->fecha))); ?></span><br>
            <span class="fila_secundario"><?php echo $fila->concepto; ?></span>
					</td>
					<td width="40%" class="monto <?php echo !empty($fila->debe)?'monto_negativo':'monto_positivo' ?>"><?php echo !empty($fila->debe)?' - $ '.$fila->debe:' + $ '.$fila->haber ?></td>
				</tr>
			</table>
		</div>
	<?php 
			endforeach; 
		else:
	?>
		<div class="fila_contenido fila_primario" style="width:93%; text-align:center; padding:2%;">No hay datos</div>
	<?php	
		endif;
	?>
</div>