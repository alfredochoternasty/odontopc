<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detcomp/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Modificar Detalle de la compra %%Compra%%', array('%%Compra%%' => $detalle_compra->getCompra()), 'messages') ?></h1>
  </div>

  <?php include_partial('detcomp/flashes') ?>
  <div title="Nuevo Producto" class="sf_admin_filter ui-helper-reset ui-helper-clearfix ui-dialog-content ui-widget-content" style="display: none; height: auto; min-height: 57.4px; width: auto;" id="dialogo_detalle_compra_producto"></div>

  <div id="sf_admin_header">
    <?php include_partial('detcomp/form_header', array('detalle_compra' => $detalle_compra, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detcomp/form', array('detalle_compra' => $detalle_compra, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detcomp/form_footer', array('detalle_compra' => $detalle_compra, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('detcomp/themeswitcher') ?>
</div>
