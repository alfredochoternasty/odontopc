<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@descuento_zona', array('id' => 'form_descuento_zona')) ?>

    <div class="sf_admin_actions_block ui-widget">
      <?php include_partial('desc_zona/form_actions', array('descuento_zona' => $descuento_zona, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div class="ui-helper-clearfix"></div>
	
    <?php echo $form->renderHiddenFields() ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

		
   	<?php 
		$count = 0;
		foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): 
			$count++;
    endforeach; 
		?>


        <div id="sf_admin_form_tab_menu">
			<?php if ($count > 1): ?>
			<ul>
	    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
				<?php $count++ ?>
				<li><a href="#sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>"><?php echo __($fieldset, array(), 'messages') ?></a></li>
	    <?php endforeach; ?>
			</ul>
			<?php endif ?>
			
	    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
	      <?php include_partial('desc_zona/form_fieldset', array('descuento_zona' => $descuento_zona, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
	    <?php endforeach; ?>
		</div>


    <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
      <?php include_partial('desc_zona/form_actions', array('descuento_zona' => $descuento_zona, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

  </form>
</div>
<script type="text/javascript">
$(".sf_admin_form_field_cliente_id").hide();
$(".sf_admin_form_field_grupoprod_id").hide();
$(".sf_admin_form_field_producto_id").hide();

$(".sf_admin_form_field_operacion").change(function(event){
	var id = $(".sf_admin_form_field_operacion").find(':selected').val();
	switch (id) {
		case 'cliente':
			$(".sf_admin_form_field_cliente_id").show();
			$(".sf_admin_form_field_grupoprod_id").hide();
			$(".sf_admin_form_field_producto_id").hide();
			break;
		case 'grupo':
			$(".sf_admin_form_field_grupoprod_id").show();
			$(".sf_admin_form_field_cliente_id").hide();
			$(".sf_admin_form_field_producto_id").hide();
			break;
		case 'producto':
			$(".sf_admin_form_field_cliente_id").hide();
			$(".sf_admin_form_field_grupoprod_id").hide();
			$(".sf_admin_form_field_producto_id").show();
			break;
		default:
			$(".sf_admin_form_field_cliente_id").hide();
			$(".sf_admin_form_field_grupoprod_id").hide();
			$(".sf_admin_form_field_producto_id").hide();
	}
});
</script>