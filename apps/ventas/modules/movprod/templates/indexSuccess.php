<?php use_helper('I18N', 'Date') ?>
<?php include_partial('movprod/assets') ?>

<div id="sf_admin_container">
  <div class="sf_admin_flashes ui-widget">
    <div class="notice ui-state-highlight ui-corner-all">
      <span class="ui-icon ui-icon-info floatleft"></span>&nbsp;
      <?php echo __('Se muestran las ventas que no sean asociadas a un remito y los remitos', array(), 'sf_admin') ?>
    </div>
  </div>
  <?php include_partial('movprod/flashes') ?>
  <div id="sf_admin_header">
    <?php include_partial('movprod/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('movprod/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
        <?php include_partial('movprod/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('movprod/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>

      <ul class="sf_admin_actions">
        <?php include_partial('movprod/list_batch_actions', array('helper' => $helper)) ?>
      </ul>

      </div>

  <div id="sf_admin_footer">
    <?php include_partial('movprod/list_footer', array('pager' => $pager)) ?>
  </div>

  <?php include_partial('movprod/themeswitcher') ?>
</div>
