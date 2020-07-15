<?php use_helper('I18N', 'Date') ?>
<?php include_partial('listcob/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('listcob/flashes') ?>

    <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('listcob/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

  
  <div id="sf_admin_content">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
      			<?php include_partial('listcob/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('listcob/list', array('helper' => $helper, 'hasFilters' => $hasFilters)) ?>

      <ul class="sf_admin_actions">
        <?php include_partial('listcob/list_batch_actions', array('helper' => $helper)) ?>
      </ul>

      </div>
</div>
