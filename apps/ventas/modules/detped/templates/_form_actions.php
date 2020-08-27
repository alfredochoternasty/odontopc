<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'label' => 'Cancelar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'label' => 'Guardar y Agregar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Guardar y Finalizar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ', 'confirm' => 'Segudo que quiere finalizar el pedido? Una vez finalizado no puede volver a modificarlo', 'class_suffix' => 'save',  'ui-icon' => '',)) ?>
  <li class="sf_admin_action_save"><button type="submit" class="fg-button ui-state-default fg-button-icon-left">Finalizar</button></li>
<?php else: ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Seguro que quiere borrar este item?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToList(array(  'label' => 'Cancelar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'label' => 'Guardar y Agregar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Guardar y Finalizar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ', 'confirm' => 'Segudo que quiere finalizar el pedido? Una vez finalizado no puede volver a modificarlo',  'class_suffix' => 'save',  'ui-icon' => '',)) ?>
<?php endif; ?>
</ul>