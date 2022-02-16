<?php use_helper('I18N', 'Date') ?>
<?php include_partial('insc_curso/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Por favor ingrese sus datos', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('insc_curso/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('insc_curso/form_header', array('curso_inscripcion' => $curso_inscripcion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('insc_curso/form', array('curso_inscripcion' => $curso_inscripcion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'curso' => $curso)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('insc_curso/form_footer', array('curso_inscripcion' => $curso_inscripcion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('insc_curso/themeswitcher') ?>
</div>
