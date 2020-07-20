<?php 
if ($actions = $this->configuration->getValue('list.actions')): 
	$actions = array_merge($actions, array('imprimir_pagina', 'imprimir_todo', 'excel_pagina', 'excel_todo'));
	foreach ($actions as $name => $params) {
		if ('_new' == $name) {
			echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n";
		} else { ?>
			<li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
			<?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params)."\n" ?>
			</li>
	<?php } 
	}
 endif; 
 ?>
