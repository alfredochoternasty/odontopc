<?php use_helper('I18N', 'Date') ?>
<?php include_partial('usuario/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
	<h3 class="titulo">Modificar Clave</h3>
  <div style="width:100%;display:flex;justify-content:center;color:#ff0000;">
    <?php $base_url = $sf_user->getVarConfig('base_url'); ?>
    <img src="<?php echo $base_url?>/sfDoctrinePlugin/images/error.png">
    <?php include_partial('usuario/flashes') ?>
  </div>
  <div id="sf_admin_content" style="display:flex;justify-content:center;">
    <div class="sf_admin_form">
      <?php echo form_tag_for($form, '@usuario', array('id' => 'form_sf_guard_user')) ?>
        <div class="ui-helper-clearfix"></div>
        <?php 
          echo $form->renderHiddenFields();
          if ($form->hasGlobalErrors()) echo $form->renderGlobalErrors();
        ?>
        <div id="sf_admin_form_tab_menu">
          <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
            <?php include_partial('usuario/form_fieldset', array('sf_guimgard_user' => $sf_guard_user, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
          <?php endforeach; ?>
        </div>
        <?php include_partial('usuario/form_actions', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </form>
    </div>
  </div>

</div>