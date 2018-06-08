<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detped/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo Pedido', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('detped/flashes') ?>
  
  <div id="sf_admin_header">
    <?php include_partial('detped/form_header', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detped/form', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    
    <?php
      if(count($pager2) > 0):
    ?>
    <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
    <table>
      <caption class="fg-toolbar ui-widget-header">
        <h1><span class="ui-icon"></span> <?php echo __('Detalle del Pedido', array(), 'messages') ?></h1>
      </caption>    
      <thead class="ui-widget-header">
        <tr>
          <?php include_partial('detped/list_th_tabular', array('sort' => ' ')) ?>
        </tr>
      </thead>          
    <tbody>
    <?php foreach($pager2 as $detpedido): ?>
    <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">    
      <td class="sf_admin_text sf_admin_list_td_Producto">
        <?php echo $detpedido->getProducto() ?>
      </td>
      <td class="sf_admin_text sf_admin_list_td_cantidad">
        <?php echo $detpedido->getPrecio() ?>
      </td>      
      <td class="sf_admin_text sf_admin_list_td_cantidad">
        <?php echo $detpedido->getCantidad() ?>
      </td>
      <td class="sf_admin_text sf_admin_list_td_observacion">
        <?php echo $detpedido->getObservacion() ?>
      </td>    
    </tr>
    <?php 
      endforeach; 
    endif;
    ?>
    </tbody>
    </table>
</div>
    
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detped/form_footer', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

</div>