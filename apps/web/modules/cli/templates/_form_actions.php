<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'label' => 'Save',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'label' => 'Save and add',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo $helper->linkToList(array(  'label' => 'Volver',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Guardar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'label' => 'Guardar y agregar otro',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'ui-icon' => '',)) ?>
<?php $modulo_pedidos = $sf_user->getVarConfig('modulo_pedidos'); ?>
<?php if ($modulo_pedidos == 'S') { ?>
	  <li class="sf_admin_action_generar_usuario">
<?php if (method_exists($helper, 'linkToGenerarUsuario')): ?>
  <?php echo $helper->linkToGenerarUsuario($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'generar_usuario',  'label' => 'Generar usuario',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo link_to(__('Generar usuario', array(), 'messages'), 'cli/ListGenerarUsuario?id='.$cliente->getId(), 'class= fg-button ui-state-default fg-button-icon-left ') ?>
<?php endif; ?>
  </li>
<?php } ?>
<?php endif; ?>
</ul>