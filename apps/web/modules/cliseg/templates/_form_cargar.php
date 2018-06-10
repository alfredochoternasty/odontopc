<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@cliente_seguimiento', array('id' => 'form_cliente_seguimiento')) ?>

    <div class="sf_admin_actions_block ui-widget">
      <?php include_partial('cliseg/form_actions', array('cliente_seguimiento' => $cliente_seguimiento, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
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
			
		<?php 
			echo '<br><span style="font-size: 1.2em;font-weight: bold;margin-right: 15px;margin-left: 10px;">Cliente: </span><span style="font-size: 1.2em;">' . $cliente_seguimiento->getCliente().'</span>';
			echo '<br><span style="font-size: 1.2em;font-weight: bold;margin-right: 15px;margin-left: 10px;">Motivo: </span><span style="font-size: 1.2em;">' . $cliente_seguimiento->getTipoMotivo().'</span>';
			echo '<br><span style="font-size: 1.2em;font-weight: bold;margin-right: 15px;margin-left: 10px;">Fecha: </span><span style="font-size: 1.2em;">' . $cliente_seguimiento->getFecha().'</span>';
			echo '<br><span style="font-size: 1.2em;font-weight: bold;margin-right: 15px;margin-left: 10px;">Hora: </span><span style="font-size: 1.2em;">' . $cliente_seguimiento->getHora().'</span>';
			echo '<br><span style="font-size: 1.2em;font-weight: bold;margin-right: 15px;margin-left: 10px;">Tipo: </span><span style="font-size: 1.2em;">' . $cliente_seguimiento->getTipoContacto().'</span>';
		?>
	    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
	      <?php include_partial('cliseg/form_fieldset', array('cliente_seguimiento' => $cliente_seguimiento, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
	    <?php endforeach; ?>
		</div>


    <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
      <?php include_partial('cliseg/form_actions', array('cliente_seguimiento' => $cliente_seguimiento, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

  </form>
</div>
