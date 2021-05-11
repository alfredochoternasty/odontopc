<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardUser/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Modificar Clave', array(), 'messages') ?></h1>
  </div>
  
  <?php include_partial('sfGuardUser/flashes') ?>
  <div id="sf_admin_content" style="display:flex;justify-content:center;">
    <div class="sf_admin_form">
      <?php echo form_tag_for($form, '@sf_guard_user', array('id' => 'form_sf_guard_user')) ?>
        <div class="ui-helper-clearfix"></div>
        <?php 
          echo $form->renderHiddenFields();
          if ($form->hasGlobalErrors()) echo $form->renderGlobalErrors();
        ?>
        <div id="sf_admin_form_tab_menu">          
          <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
            <?php include_partial('sfGuardUser/form_fieldset', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
          <?php endforeach; ?>
        </div>
        <?php include_partial('sfGuardUser/form_actions', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </form>
    </div>
  </div>

</div>
