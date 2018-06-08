<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detpedidos/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Modificar de pedido', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('detpedidos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detpedidos/form_header', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('detpedidos/form', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('detpedidos/form_footer', array('detalle_pedido' => $detalle_pedido, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('detpedidos/themeswitcher') ?>
</div>

 <?php if(!$sf_user->hasPermission('cliente')): ?>    
 <script type="text/javascript">
 $(document).ready(function(){
    var pid = $("#detalle_pedido_producto_id").find(':selected').val();
    $.ajax({
        url: 'get_lotes_producto?pid='+pid,
        //dataType: "json",
        success: function(data) {
          $("#detalle_resumen_nro_lote").html('');
          $("#detalle_resumen_nro_lote").html(data);
        }
      });                  
  });
</script>
 <?php endif; ?>
