<?php use_helper('I18N', 'Date') ?>
<?php include_partial('resumen/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('resumen/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('resumen/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('resumen/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
      <?php include_partial('resumen/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>
    </div>

  <div id="sf_admin_footer">
    <?php include_partial('resumen/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
