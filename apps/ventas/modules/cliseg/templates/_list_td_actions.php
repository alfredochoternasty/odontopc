<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
      
          <?php echo $helper->linkToDelete($cliente_seguimiento, array(  'label' => 'Eliminar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'ui-icon' => '',)) ?>
          <?php if (!$cliente_seguimiento->getRealizada()) {?>
          <li class="sf_admin_action_hecho">
			<?php echo link_to(__('Hecho', array(), 'messages'), 'cliseg/List_hecho?id='.$cliente_seguimiento->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
		  </li>
		  <?php }?>
        </ul>
</td>
