<?php	
if ($resumen->pagado > 0) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png');
if ($resumen->pagado > 1) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/error.png', 'alt="'.$resumen->afip_mensaje.'"');
?>