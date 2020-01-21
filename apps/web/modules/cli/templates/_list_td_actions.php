<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
      
          <?php echo $helper->linkToDelete($cliente, array(  'label' => 'Eliminar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'ui-icon' => '',)) ?>
          
          <?php echo $helper->linkToEdit($cliente, array(  'label' => 'Modificar',  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'edit',  'ui-icon' => '',)) ?>
          <?php 
            $modulo_pedidos = $sf_user->getVarConfig('modulo_pedidos');
            if ($modulo_pedidos == 'S') { ?>
              <li class="sf_admin_action_usuario">
              <?php echo link_to(__('Generar Usuario', array(), 'messages'), 'cli/ListUsuario?id='.$cliente->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
            </li>
          <?php } ?>
        </ul>
</td>
