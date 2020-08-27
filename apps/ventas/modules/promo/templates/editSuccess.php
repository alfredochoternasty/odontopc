<?php use_helper('I18N', 'Date') ?>
<?php include_partial('promo/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Edit Promo', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('promo/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('promo/form_header', array('promocion' => $promocion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('promo/form', array('promocion' => $promocion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('promo/form_footer', array('promocion' => $promocion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
  <?php if (!empty($productos_requisitos[0])) include_partial('list_productos', array('productos' => $productos_requisitos, 'titulo_cuadro' => 'Productos Requisitos', 'accion' => 'ListBorrarProdRequisito')) ?>
  <?php if (!empty($productos_promo[0])) include_partial('list_productos', array('productos' => $productos_promo, 'titulo_cuadro' => 'Productos Promocionados', 'accion' => 'ListBorrarProdPromo')) ?>
  <?php include_partial('promo/themeswitcher') ?>
</div>

<script type="text/javascript">
function checkAll(){
  var boxes = document.getElementsByTagName('input'); 
	for(var index = 0; index < boxes.length; index++) { 
		box = boxes[index]; 
		if (box.type == 'checkbox') {
			box.checked = !box.checked;
		}
	}
	return true;
}
</script>
