<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detpedidos/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('detpedidos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detpedidos/list_header', array('pager' => $pager)) ?>
  </div>
  
  <div id="sf_admin_content">    
    <?php 
      $detalles = $pager->getResults();
      if (empty($detalles[0]->getPedido()->vendido)):?>
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
        <?php include_partial('detpedidos/list_actions', array('helper' => $helper)) ?>
      </div>
    <?php endif; ?>
    <?php include_partial('detpedidos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'filters' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detpedidos/list_footer', array('pager' => $pager)) ?>
  </div>

</div>
