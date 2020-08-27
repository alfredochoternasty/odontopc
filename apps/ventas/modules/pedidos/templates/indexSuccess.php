<?php use_helper('I18N', 'Date') ?>
<?php include_partial('pedidos/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('pedidos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('pedidos/list_header', array('pager' => $pager)) ?>
  </div>
  
  <div id="sf_admin_content">
          <form action="<?php echo url_for('pedido_pedidos_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    


      <?php include_partial('pedidos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) ?>

          </form>
      </div>

  <div id="sf_admin_footer">
    <?php include_partial('pedidos/list_footer', array('pager' => $pager)) ?>
  </div>

</div>
