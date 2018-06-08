<td colspan="4">
  <?php echo __('%%nombre%% - %%nro_lote%% - %%stock%% - %%minimo_stock%%', array('%%nombre%%' => $producto->getNombre(), '%%nro_lote%%' => $producto->getNroLote(), '%%stock%%' => $producto->getStock(), '%%minimo_stock%%' => $producto->getMinimoStock()), 'messages') ?>
</td>
