<td style="white-space: nowrap;">
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
  <?php
    $vendido = $pedido->getVendido();
    if($vendido == 0){
      echo $helper->linkToDelete($pedido, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',));
    }
    ?>
    <li class="sf_admin_action_detalle">
      <?php echo link_to(__('Ver Detalle', array(), 'messages'), 'ped/ListDetalle?id='.$pedido->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
    </li>
  </ul>
</td>
