<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
      
          <?php echo $helper->linkToDelete($detalle_pedido, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
          
          <?php echo $helper->linkToEdit($detalle_pedido, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'edit',  'label' => 'Edit',  'ui-icon' => '',)) ?>
        </ul>
</td>
