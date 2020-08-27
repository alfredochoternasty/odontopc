<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detpresu/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo detalle del presupuesto', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('detpresu/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detpresu/form_header', array('detalle_presupuesto' => $detalle_presupuesto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detpresu/form', array('detalle_presupuesto' => $detalle_presupuesto, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

    <?php 
      if(count($presupuesto_detalle) > 0):
        include_partial('detpresu/list_detalle', array('presupuesto_detalle' => $presupuesto_detalle, 'helper' => $helper));
      endif; 
    ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detpresu/form_footer', array('detalle_presupuesto' => $detalle_presupuesto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

</div>
