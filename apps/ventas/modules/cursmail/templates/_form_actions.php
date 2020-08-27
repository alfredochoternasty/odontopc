<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
	<?php 
		////window.location = this.href;
		echo link_to('Enviar', '@curso_mail_enviado', array(
		'class'  => 'fg-button ui-state-default fg-button-icon-left',
		'onclick' => "
			var curso_id = $('#curso_mail_enviado_curso_id').val();
			var tipo_id = $('#curso_mail_enviado_tipo_envio').val();
			var cliente_id = $('#curso_mail_enviado_cliente_id').val();
			var email = $('#curso_mail_enviado_e_mail').val();
			var url = 'enviar?cid='+curso_id+'&tid='+tipo_id+'&cli='+cliente_id+'&email='+email;
			window.open(url);"
	)) ?>	
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
<?php endif; ?>
</ul>