<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cobro/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo Cobro', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('cobro/flashes') ?>
	<div title="Nuevo Banco" class="sf_admin_filter ui-helper-reset ui-helper-clearfix ui-dialog-content ui-widget-content" style="display: none; height: auto; min-height: 57.4px; width: auto;" id="dialogo_cobro_banco"></div>
  <div id="sf_admin_header">
    <?php include_partial('cobro/form_header', array('cobro' => $cobro, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('cobro/form', array('cobro' => $cobro, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('cobro/form_footer', array('cobro' => $cobro, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('cobro/themeswitcher') ?>
</div>
