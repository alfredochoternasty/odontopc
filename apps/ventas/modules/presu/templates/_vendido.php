<?php	
if ($presupuesto->vendido > 0) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png');
?>