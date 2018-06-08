<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'label' => 'Cancelar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Guardar y Finalizar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'label' => 'Guardar y Agregar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'ui-icon' => '',)) ?>
	  <li class="sf_admin_action_finalizar">
<?php if (method_exists($helper, 'linkToFinalizar')): ?>
  <?php echo $helper->linkToFinalizar($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'finalizar',  'label' => 'Finalizar',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo link_to(__('Finalizar', array(), 'messages'), 'detped/ListFinalizar', 'class= fg-button ui-state-default fg-button-icon-left ') ?>
<?php endif; ?>
  </li>
<?php else: ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToList(array(  'label' => 'Cancelar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Guardar y Finalizar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'label' => 'Guardar y Agregar',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'ui-icon' => '',)) ?>
<?php endif; ?>
</ul>