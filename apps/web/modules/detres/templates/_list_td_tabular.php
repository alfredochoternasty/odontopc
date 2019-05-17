<td class="sf_admin_text sf_admin_list_td_Producto">
  <?php echo $detalle_resumen->getProducto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php echo $detalle_resumen->getNroLote() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nro_lote">
  <?php 
    $lote = $detalle_resumen->getNroLote();
    if($lote[0] != 'i'){
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

<?php if($detalle_resumen->getResumen()->tipofactura_id == 4): ?>
	<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $detalle_resumen->RemitoProductoCantVend() ?></td>
	<td class="sf_admin_text sf_admin_list_td_cantidad"><?php echo $detalle_resumen->getCantidad() - $detalle_resumen->RemitoProductoCantVend()?></td>
<?php endif;?>

<?php if($detalle_resumen->getResumen()->tipofactura_id != 4): ?>
	<td class="sf_admin_text sf_admin_list_td_precio"><?php echo $detalle_resumen->PrecioFormato() ?></td>
	<?php if($sf_user->hasGroup('Blanco')): ?>
		<td class="sf_admin_text sf_admin_list_td_sub_total"><?php echo $detalle_resumen->SubTotalFormato() ?></td>
		<td class="sf_admin_text sf_admin_list_td_total"><?php echo $detalle_resumen->IvaFormato() ?></td>
	<?php endif;?>
	<td class="sf_admin_text sf_admin_list_td_total"><?php echo $detalle_resumen->TotalFormato() ?></td>
	<td class="sf_admin_text sf_admin_list_td_bonificados"><?php echo $detalle_resumen->getBonificados() ?></td>
<?php endif;?>

<td class="sf_admin_text sf_admin_list_td_observacion"><?php echo $detalle_resumen->getObservacion() ?></td>
