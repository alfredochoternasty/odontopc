<td style="white-space: nowrap;">
  <?php if($detalle_resumen->getResumen()->afip_estado == 0): ?>
  <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
    <?php echo $helper->linkToDelete($detalle_resumen, array(  'params' => 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
  </ul>
  <?php endif;?>
</td>
