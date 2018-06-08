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
      <div class="sf_admin_actions_block floatleft">
      	<a tabindex="0" href="#sf_admin_actions_menu" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="sf_admin_actions_button">
      	  <span class="ui-icon ui-icon-triangle-1-s"></span>
      	  <?php echo __('Actions', array(), 'sf_admin') ?>
      	</a>
      	<div id="sf_admin_actions_menu" class="ui-helper-hidden fg-menu fg-menu-has-icons">
      		<ul class="sf_admin_actions" id="sf_admin_actions_menu_list">
      			<?php include_partial('detpedidos/list_actions', array('helper' => $helper)) ?>
      		</ul>
      	</div>
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
