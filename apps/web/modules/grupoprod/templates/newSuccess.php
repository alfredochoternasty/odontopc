<?php use_helper('I18N', 'Date') ?>
<?php include_partial('grupoprod/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Nuevo Grupo', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('grupoprod/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('grupoprod/form_header', array('grupoprod' => $grupoprod, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('grupoprod/form', array('grupoprod' => $grupoprod, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('grupoprod/form_footer', array('grupoprod' => $grupoprod, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('grupoprod/themeswitcher') ?>
</div>
<script type="text/javascript">
 
var color = $('#grupoprod_color').val();
$('#grupoprod_color').css('backgroundColor', '#' + color);

$('#grupoprod_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);    
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	},
  onChange: function (hsb, hex, rgb) {
		$('#grupoprod_color').css('backgroundColor', '#' + hex);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
</script>