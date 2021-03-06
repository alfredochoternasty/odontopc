<?php use_helper('I18N', 'Date') ?>
<?php include_partial('listvta/assets') ?>

<div id="sf_admin_container">
  <div class="sf_admin_flashes ui-widget">
    <div class="notice ui-state-highlight ui-corner-all">
      <span class="ui-icon ui-icon-info floatleft"></span>&nbsp;
      <?php echo __('Se muestran las ventas, las ventas asociadas a un remito y las devoluciones que no sean asociadas a un remito', array(), 'sf_admin') ?>
    </div>
  </div>
    <?php include_partial('listvta/flashes') ?>

    <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('listvta/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

  
  <div id="sf_admin_content">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
      			<?php include_partial('listvta/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('listvta/list', array('pager' => $pager, 'helper' => $helper, 'sort' => $sort, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>

      <ul class="sf_admin_actions">
        <?php include_partial('listvta/list_batch_actions', array('helper' => $helper)) ?>
      </ul>

      </div>

  <?php include_partial('listvta/themeswitcher') ?>
</div>
