<?php
if ($field->isPartial()): ?>
  <?php include_partial('resumen/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('resumen', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: 
if($name == 'nro_factura'){
	if($sf_user->hasGroup('Blanco')){ ?>
		<div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
		<div class="label ui-helper-clearfix">
		  <?php echo $form[$name]->renderLabel($label) ?>

		  <?php if ($help || $help = $form[$name]->renderHelp()): ?>
			<div class="help">
			  <span class="ui-icon ui-icon-help floatleft"></span>
			  <?php echo __(strip_tags($help), array(), 'messages') ?>
			</div>
		  <?php endif; ?>
		</div>

		<?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes);
		if($name == 'cliente_id'){
		  //position: relative; top: -8px; para firefox
		  echo '<button id="boton_resumen_cliente_id" style="margin-left: 10px;" class="fg-button ui-state-default fg-button-icon-left ui-state-hover" type="button"><span class="ui-icon ui-icon-document"></span>Agregar Nuevo Cliente</button>';
		}

		if ($form[$name]->hasError()): ?>
		  <div class="errors">
			<span class="ui-icon ui-icon-alert floatleft"></span>
			<?php echo $form[$name]->renderError() ?>
		  </div>
		<?php endif; ?>
		</div>		
<?php
	}
	}else{ ?>
	  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
		<div class="label ui-helper-clearfix">
		  <?php echo $form[$name]->renderLabel($label) ?>

		  <?php if ($help || $help = $form[$name]->renderHelp()): ?>
			<div class="help">
			  <span class="ui-icon ui-icon-help floatleft"></span>
			  <?php echo __(strip_tags($help), array(), 'messages') ?>
			</div>
		  <?php endif; ?>
		</div>

		<?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes);
		if($name == 'cliente_id'){
		  //position: relative; top: -8px; para firefox
		  echo '<button id="boton_resumen_cliente_id" style="margin-left: 10px;" class="fg-button ui-state-default fg-button-icon-left ui-state-hover" type="button"><span class="ui-icon ui-icon-document"></span>Agregar Nuevo Cliente</button>';
		}

		if ($form[$name]->hasError()): ?>
		  <div class="errors">
			<span class="ui-icon ui-icon-alert floatleft"></span>
			<?php echo $form[$name]->renderError() ?>
		  </div>
		<?php endif; ?>
	  </div>	
<?php	
	}
endif;
?>