<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $detalle_resumen->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $detalle_resumen->getNroLote() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php 
    $lote = $detalle_resumen->getNroLote();
    if($lote[0] != 'i' && !empty($lote)){
      $lotes = Doctrine::getTable('Lote')->findByNroLote($lote);
			$fec = $lotes[0]->getFechaVto();
      if(!empty($fec)){
        echo implode('/', array_reverse(explode('-', $fec)));
      }else{
        echo 'no tiene';
      }
    }else{
      echo 'no tiene';
    }
   ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $detalle_resumen->getCantidad() ?></td>

<?php 
	if($detalle_resumen->getResumen()->tipofactura_id == 4): 
		$cant_vend = $detalle_resumen->RemitoProductoCantVend();
		$cant_dev = $detalle_resumen->RemitoProductoCantDev();
?>
	<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $cant_vend ?></td>
	<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $cant_dev ?></td>
	<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $detalle_resumen->cantidad - ($cant_vend + $cant_dev); ?></td>
<?php endif;?>

<?php if($detalle_resumen->getResumen()->tipofactura_id != 4): ?>
	<td class="sf_admin_text sf_admin_list_td_precio"><?php echo $detalle_resumen->PrecioFormato() ?></td>
	<td class="sf_admin_text sf_admin_list_td_sub_total"><?php echo $detalle_resumen->SubTotalFormato() ?></td>
	<td class="sf_admin_text sf_admin_list_td_descuento"><?php echo $detalle_resumen->getDescuento() ?></td>
	<?php
		$modulo_factura = $sf_user->getVarConfig('modulo_factura');
		if ($modulo_factura == 'S'):
	?>
		<td class="sf_admin_text sf_admin_list_td_total"><?php echo $detalle_resumen->IvaFormato() ?></td>
	<?php endif;?>
	<td class="sf_admin_text sf_admin_list_td_total"><?php echo $detalle_resumen->TotalFormato() ?></td>
<?php endif;?>

<td class="sf_admin_text sf_admin_list_td_observacion"><?php echo $detalle_resumen->getObservacion() ?></td>
