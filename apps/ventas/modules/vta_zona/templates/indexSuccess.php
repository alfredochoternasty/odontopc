<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vta_zona/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('vta_zona/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('vta_zona/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('vta_zona/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
          <form action="<?php echo url_for('ventas_zona_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
      			<?php include_partial('vta_zona/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('vta_zona/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>
      
      <?php if ($zona_id == 1): ?>
      <ul class="sf_admin_actions">
        <?php include_partial('vta_zona/list_batch_actions', array('helper' => $helper)) ?>
      </ul>
      <?php endif; ?>

          </form>
      </div>

  <div id="sf_admin_footer">
    <?php include_partial('vta_zona/list_footer', array('pager' => $pager)) ?>
  </div>

  <?php include_partial('vta_zona/themeswitcher') ?>
</div>
