<?php 
// if ($actions = $this->configuration->getValue('list.actions')):
	// /*$actions = array_merge($actions, array(
		// 'imprimir_pagina' => array('label' => ucwords(str_replace('_', ' ', 'imprimir_pagina')), 'class_suffix' => 'imprimir_pagina', 'params' => array()),
		// 'imprimir_todo' => array('label' => ucwords(str_replace('_', ' ', 'imprimir_todo')), 'class_suffix' => 'imprimir_todo', 'params' => array()),
		// 'excel_pagina' => array('label' => ucwords(str_replace('_', ' ', 'excel_pagina')), 'class_suffix' => 'excel_pagina', 'params' => array()),
		// 'excel_todo' => array('label' => ucwords(str_replace('_', ' ', 'excel_todo')), 'class_suffix' => 'excel_todo', 'params' => array())
	// ));*/
	// foreach ($actions as $name => $params) {
		// if ('_new' == $name) {
			// echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n";
		// } else {
			// echo $this->getLinkToAction($name, $params, false)."\n";
		// } 
	// }
 // endif; 
if ($actions = $this->configuration->getValue('list.actions')):
	foreach ($actions as $name => $params) {
		if ('_new' == $name) {
			echo "[?php echo link_to('".$params['label']."','".$this->getModuleName()."/new',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;')) ?]"."\n";
		} else {
			echo "[?php echo link_to('".$params['label']."','".$this->getModuleName()."/List".str_replace(' ', '', ucwords(str_replace('_', ' ', $name)))."',array('class'  => 'fg-button ui-state-default','style' => 'float: unset;font-size: larger;')) ?]"."\n";
		}  
	}
 endif; 


 ?>
