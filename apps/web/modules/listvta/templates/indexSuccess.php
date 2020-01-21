<?php use_helper('I18N', 'Date') ?>
<?php include_partial('listvta/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('listvta/flashes') ?>

    <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('listvta/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

  
  <div id="sf_admin_content">
    
      <div class="sf_admin_actions_block floatleft">
      	<a tabindex="0" href="#sf_admin_actions_menu" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="sf_admin_actions_button">
      	  <span class="ui-icon ui-icon-triangle-1-s"></span>
      	  <?php echo __('Actions', array(), 'sf_admin') ?>
      	</a>
      	<div id="sf_admin_actions_menu" class="ui-helper-hidden fg-menu fg-menu-has-icons">
      		<ul class="sf_admin_actions" id="sf_admin_actions_menu_list">
      			<?php include_partial('listvta/list_actions', array('helper' => $helper)) ?>
      		</ul>
      	</div>
      </div>

      <?php include_partial('listvta/list', array('pager' => $pager, 'helper' => $helper, 'sort' => $sort, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>

      <ul class="sf_admin_actions">
        <?php include_partial('listvta/list_batch_actions', array('helper' => $helper)) ?>
      </ul>

      </div>

  <?php include_partial('listvta/themeswitcher') ?>
</div>
