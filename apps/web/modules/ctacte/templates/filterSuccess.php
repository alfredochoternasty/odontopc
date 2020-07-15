<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ctacte/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('ctacte/flashes') ?>
    
    <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('ctacte/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
        <?php include_partial('ctacte/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('ctacte/list_filter', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) ?>

  </div>

  <?php include_partial('ctacte/themeswitcher') ?>
</div>
