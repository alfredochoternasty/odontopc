<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detpedidos/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('detpedidos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detpedidos/list_header', array('pager' => $pager)) ?>
  </div>

      <div id="sf_admin_bar ui-helper-hidden" style="display:none">
      <?php include_partial('detpedidos/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
  
  <div id="sf_admin_content">
          <form action="<?php echo url_for('detalle_pedido_detpedidos_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
    <?php
      $det_pedido = $pager->getResults();
      $vendido = $det_pedido[0]->getPedido()->getVendido();
      if($vendido == 0){
    ?>    
      <div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
      			<?php include_partial('detpedidos/list_actions', array('helper' => $helper)) ?>
      </div>
    <?php 
      }
      include_partial('detpedidos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) 
     ?>

          </form>
      </div>

  <div id="sf_admin_footer">
    <?php include_partial('detpedidos/list_footer', array('pager' => $pager)) ?>
  </div>

</div>
