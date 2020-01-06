<?php 
if($finalizado == 0)
  echo $helper->linkToNew(array(  'label' => 'Agregar Producto',  'params' => 'class= fg-button ui-state-default  ',  'class_suffix' => 'new',)) 
?>
<li class="sf_admin_action_imprimir fg-menu-has-icons">
  <?php echo link_to(__('Imprimir', array(), 'messages'), 'detped/List_imprimir', 'class= fg-button ui-state-default  ') ?>
</li>
<li class="sf_admin_action_volver fg-menu-has-icons">
  <?php echo link_to(__('Volver', array(), 'messages'), 'detped/List_volver', 'class= fg-button ui-state-default  ') ?>
</li>