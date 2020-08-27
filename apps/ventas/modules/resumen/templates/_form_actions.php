<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'Guardar y Agregar Detalle',  'label' => 'Save and add',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Volver',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'label' => 'Guardar y Volver',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'label' => 'Guardar y Ver Detalle',  'ui-icon' => '',)) ?>
<?php endif; ?>
</ul>