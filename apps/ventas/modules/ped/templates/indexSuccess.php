<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ped/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('ped/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ped/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar ui-helper-hidden" style="display:none">
    <?php include_partial('ped/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>
  
  <div id="sf_admin_content">
    <form action="<?php echo url_for('pedido_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    <?php include_partial('ped/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) ?>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('ped/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
