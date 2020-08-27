<td>
  <?php 
  $vendido = $detalle_pedido->getPedido()->getVendido();
  if($vendido == 0) {?>
    <input type="checkbox" name="ids[]" value="<?php echo $detalle_pedido->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
  <?php }else{ echo "&nbsp;"; } ?>
</td>
