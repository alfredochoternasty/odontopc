<?php use_helper('I18N', 'Date') ?>
<?php include_partial('catprod/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('catprod/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('catprod/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('catprod/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
          <form action="<?php echo url_for('categoria_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
        <?php include_partial('catprod/list_actions', array('helper' => $helper)) ?>
      </div>

      <?php include_partial('catprod/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>

          </form>
      </div>

  <div id="sf_admin_footer">
    <?php include_partial('catprod/list_footer', array('pager' => $pager)) ?>
  </div>

  <?php include_partial('catprod/tablero', array('pager' => $pager)) ?>
</div>
