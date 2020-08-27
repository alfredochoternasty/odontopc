<td>
<?php 
if($pedido->getVendido() == 0){ ?>
  <input type="checkbox" name="ids[]" value="<?php echo $pedido->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
<?php } ?>
</td>
