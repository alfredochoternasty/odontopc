<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detped/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo Pedido', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('detped/flashes') ?>
  
  <div id="sf_admin_header">
    <?php include_partial('detped/form_header', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detped/form', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    
    <?php
      if(count($pager2) > 0):
        include_partial('detped/detalle', array('pager2' => $pager2, 'sort' => array('producto', 'asc'), 'helper' => $helper));
      endif;
    ?>
    
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detped/form_footer', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

</div>