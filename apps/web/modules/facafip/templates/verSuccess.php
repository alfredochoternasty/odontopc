<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php include_partial('carrito/boton_carrito') ?>
<div class="contenido">
	<h3 class="titulo">Facturas Recibidas</h3>
	<?php 
		if (count($facturas) > 0):
			foreach ($facturas as $fila): ?>
		<a href="<?php echo url_for('facafip/imprimir?rid='.$fila->id, true) ?>">
		<div class="fila_contenido">
			<table width="100%">
				<tr>
					<td>
						<span class="fila_primario"><?php include_partial('comprobante', array('facturas_afip' => $fila)); ?></span><br>
						<span class="fila_secundario"><?php echo implode('/', array_reverse(explode('-', $fila->fecha))); ?></span><br>
					</td>
					<td width="30%" class="precio"><?php echo sprintf("$"." %01.2f", $fila->total) ?></td>
				</tr>
			</table>
		</div>
		</a>
	<?php 
			endforeach; 
		else:
	?>
		<div class="fila_contenido fila_primario" style="width:93%; text-align:center; padding:2%;">No hay datos</div>
	<?php	
		endif;
	?>
</div>