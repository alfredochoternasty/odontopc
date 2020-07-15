<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detped/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('detped/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detped/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('detped/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
    <form action="<?php echo url_for('detalle_pedido_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    <?php
      $det_pedido = $pager->getResults();
      $finalizado = $det_pedido[0]->getPedido()->getFinalizado();
    ?>
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
      			<?php include_partial('detped/list_actions', array('helper' => $helper, 'finalizado' => $finalizado)) ?>
      </div>

      <?php
      include_partial('detped/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters));
      ?>
      
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detped/list_footer', array('pager' => $pager)) ?>
  </div>

</div>
