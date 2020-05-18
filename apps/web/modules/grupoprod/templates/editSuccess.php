<?php use_helper('I18N', 'Date') ?>
<?php include_partial('grupoprod/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Modificar Grupo', array(), 'messages') ?></h1>
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
$(".sf_admin_form_field_precio_vta").hide();
$(".sf_admin_form_field_iva").hide();
$(".sf_admin_form_field_total").hide();
$(".sf_admin_form_field_productos").hide();
$(".sf_admin_form_field_porcentaje").hide();

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

$(".sf_admin_form_field_operacion").change(function(event){
	var id = $(".sf_admin_form_field_operacion").find(':selected').val();
	switch (id) {
		case 'precio':
			$(".sf_admin_form_field_precio_vta").show();
			$(".sf_admin_form_field_iva").show();
			$(".sf_admin_form_field_total").show();
			$(".sf_admin_form_field_productos").show();
			$(".sf_admin_form_field_porcentaje").hide();
			break;
		case 'aumento':
			$(".sf_admin_form_field_precio_vta").hide();
			$(".sf_admin_form_field_iva").hide();
			$(".sf_admin_form_field_total").hide();
			$(".sf_admin_form_field_productos").show();
			$(".sf_admin_form_field_porcentaje").show();
			break;
		case 'descuento':
			$(".sf_admin_form_field_precio_vta").hide();
			$(".sf_admin_form_field_iva").hide();
			$(".sf_admin_form_field_total").hide();
			$(".sf_admin_form_field_productos").show();
			$(".sf_admin_form_field_porcentaje").show();
			break;
		default:
			$(".sf_admin_form_field_precio_vta").hide();
			$(".sf_admin_form_field_iva").hide();
			$(".sf_admin_form_field_total").hide();
			$(".sf_admin_form_field_productos").hide();
			$(".sf_admin_form_field_porcentaje").hide();
	}
});


$("#grupoprod_total").bind("propertychange keyup input paste", function(event){
	var total = $("#grupoprod_total").val();
	total = total * 1;
	var precio = truncar(total / 1.21, 2);
	var iva = total - precio;
	$("#grupoprod_iva").attr('value', iva.toFixed(2));
	$("#grupoprod_precio_vta").attr('value', precio.toFixed(2));
});
</script>