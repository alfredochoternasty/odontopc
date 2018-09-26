<?php if ($field->isPartial()): ?>
  <?php include_partial('cobro/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('cobro', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
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
    
    <?php if($name != 'resumen_id'){ ?>
    <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    <?php } ?>
    
    <?php 
		if($name == 'banco_id'){
			echo '<button id="boton_cobro_banco_id" style="margin-left: 10px" class="fg-button ui-state-default ui-state-hover" type="button">Agregar Nuevo Banco</button>';
		}
		?>
    
    <?php if ($form[$name]->hasError()): ?>
      <div class="errors">
        <span class="ui-icon ui-icon-alert floatleft"></span>
        <?php echo $form[$name]->renderError() ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
